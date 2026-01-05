<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Party;
use App\Models\PartyPosition;
use App\Models\TestResult;
use Illuminate\Console\Command;

class RecalculateTestResults extends Command
{
    protected $signature = 'tests:recalculate 
                            {--dry-run : Simular sin guardar cambios}
                            {--limit= : Limitar número de tests a procesar}
                            {--id= : Recalcular solo un test específico por ID}';

    protected $description = 'Recalcular los resultados de todos los tests completados usando el algoritmo corregido con polaridad';

    /**
     * Categorías económicas para la brújula política
     */
    private array $economicCategories = [
        'economía',
        'economia',
        'fiscalidad',
        'empleo',
        'trabajo',
        'vivienda',
        'pensiones',
        'bienestar',
        'agricultura',
        'rural'
    ];

    /**
     * Categorías sociales para la brújula política
     */
    private array $socialCategories = [
        'social',
        'inmigración',
        'inmigracion',
        'seguridad',
        'justicia',
        'instituciones',
        'monarquía',
        'monarquia',
        'educación',
        'educacion',
        'sanidad',
        'medio ambiente',
        'medioambiente',
        'igualdad',
        'derechos'
    ];

    /**
     * Cache para las polaridades de las preguntas
     */
    private array $questionPolarityCache = [];

    /**
     * IDs de partidos de izquierda
     */
    private ?array $leftPartyIds = null;

    /**
     * IDs de partidos de derecha
     */
    private ?array $rightPartyIds = null;

    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $limit = $this->option('limit');
        $specificId = $this->option('id');

        if ($dryRun) {
            $this->warn('🔍 MODO DRY-RUN: No se guardarán cambios');
            $this->newLine();
        }

        // Inicializar referencias de partidos para polaridad
        $this->initPartyReferences();

        $query = TestResult::where('is_completed', true)
            ->whereNotNull('results');

        if ($specificId) {
            $query->where('id', $specificId);
        }

        if ($limit) {
            $query->limit((int) $limit);
        }

        $tests = $query->get();
        $total = $tests->count();

        if ($total === 0) {
            $this->error('No se encontraron tests para recalcular.');
            return 1;
        }

        $this->info("📊 Recalculando {$total} tests con el algoritmo corregido...");
        $this->newLine();

        $parties = Party::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get()->keyBy('id');

        $stats = [
            'processed' => 0,
            'changed' => 0,
            'unchanged' => 0,
            'errors' => 0,
            'compass_changes' => 0,
        ];

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($tests as $test) {
            try {
                $answers = $test->answers()->with('question.category')->get();

                if ($answers->isEmpty()) {
                    $stats['errors']++;
                    $bar->advance();
                    continue;
                }

                // Guardar valores antiguos
                $oldCompass = is_array($test->compass_position)
                    ? $test->compass_position
                    : json_decode($test->compass_position, true);

                // Calcular nuevos valores con polaridad corregida
                $newResultsData = $this->calculateResults($answers, $parties);
                $newCompassPosition = $this->calculateCompassPosition($answers);
                $newCategoryScores = $this->calculateCategoryScores($answers, $categories);

                // Detectar cambios significativos en la brújula
                $compassChanged = false;
                if ($oldCompass) {
                    $economicDiff = abs(($oldCompass['economic'] ?? 0) - ($newCompassPosition['economic'] ?? 0));
                    $socialDiff = abs(($oldCompass['social'] ?? 0) - ($newCompassPosition['social'] ?? 0));

                    // Consideramos cambio significativo si hay > 10 puntos de diferencia
                    if ($economicDiff > 10 || $socialDiff > 10) {
                        $compassChanged = true;
                        $stats['compass_changes']++;
                    }
                }

                if (!$dryRun) {
                    $test->update([
                        'results' => $newResultsData['results'],
                        'compass_position' => $newCompassPosition,
                        'category_scores' => $newCategoryScores,
                        'top_party_id' => $newResultsData['topPartyId'],
                    ]);
                }

                $stats['processed']++;
                if ($compassChanged) {
                    $stats['changed']++;
                } else {
                    $stats['unchanged']++;
                }
            } catch (\Exception $e) {
                $stats['errors']++;
                $this->error("\nError en test {$test->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Mostrar estadísticas
        $this->info('📈 Estadísticas:');
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Tests procesados', $stats['processed']],
                ['Brújulas con cambio significativo (>10pts)', $stats['compass_changes']],
                ['Sin cambios significativos', $stats['unchanged']],
                ['Errores', $stats['errors']],
            ]
        );

        if ($dryRun) {
            $this->warn("\n⚠️ MODO DRY-RUN: No se guardaron cambios. Ejecuta sin --dry-run para aplicar.");
        } else {
            $this->info("\n✅ Recálculo completado y guardado.");
        }

        return 0;
    }

    /**
     * Inicializar IDs de partidos de referencia para cálculo de polaridad.
     */
    private function initPartyReferences(): void
    {
        $this->leftPartyIds = Party::whereIn('slug', ['psoe', 'sumar', 'bildu', 'erc'])
            ->pluck('id')
            ->toArray();

        $this->rightPartyIds = Party::whereIn('slug', ['pp', 'vox', 'alianca-catalana'])
            ->pluck('id')
            ->toArray();

        $this->info("Partidos de izquierda (IDs): " . implode(', ', $this->leftPartyIds));
        $this->info("Partidos de derecha (IDs): " . implode(', ', $this->rightPartyIds));
        $this->newLine();
    }

    /**
     * Calcular la polaridad de una pregunta basándose en las posiciones de los partidos.
     */
    private function calculateQuestionPolarity(int $questionId): int
    {
        if (isset($this->questionPolarityCache[$questionId])) {
            return $this->questionPolarityCache[$questionId];
        }

        $positions = PartyPosition::where('question_id', $questionId)->get();

        if ($positions->isEmpty()) {
            $this->questionPolarityCache[$questionId] = 1;
            return 1;
        }

        $leftSum = 0;
        $leftCount = 0;
        $rightSum = 0;
        $rightCount = 0;

        foreach ($positions as $position) {
            if (in_array($position->party_id, $this->leftPartyIds)) {
                $leftSum += $position->position;
                $leftCount++;
            } elseif (in_array($position->party_id, $this->rightPartyIds)) {
                $rightSum += $position->position;
                $rightCount++;
            }
        }

        $leftAvg = $leftCount > 0 ? $leftSum / $leftCount : 3;
        $rightAvg = $rightCount > 0 ? $rightSum / $rightCount : 3;

        // Si izquierda tiene posiciones más altas, la polaridad es inversa (-1)
        $polarity = ($leftAvg > $rightAvg) ? -1 : 1;

        $this->questionPolarityCache[$questionId] = $polarity;
        return $polarity;
    }

    /**
     * Calcular posición en la brújula política (VERSIÓN CORREGIDA)
     */
    private function calculateCompassPosition($answers): array
    {
        $economicScores = [];
        $socialScores = [];

        foreach ($answers as $answer) {
            if (!$answer->question || !$answer->question->category) {
                continue;
            }

            // ✅ CORRECCIÓN: Obtener polaridad de la pregunta
            $polarity = $this->calculateQuestionPolarity($answer->question_id);

            $categoryName = strtolower($answer->question->category->name);
            $categorySlug = strtolower($answer->question->category->slug ?? '');

            // ✅ CORRECCIÓN: Aplicar polaridad al score
            $normalizedScore = (($answer->answer - 3) / 2) * 100 * $polarity;

            $isEconomic = false;
            $isSocial = false;

            foreach ($this->economicCategories as $ec) {
                if (str_contains($categoryName, $ec) || str_contains($categorySlug, $ec)) {
                    $isEconomic = true;
                    break;
                }
            }

            foreach ($this->socialCategories as $sc) {
                if (str_contains($categoryName, $sc) || str_contains($categorySlug, $sc)) {
                    $isSocial = true;
                    break;
                }
            }

            if (!$isEconomic && !$isSocial) {
                $isEconomic = true;
                $isSocial = true;
            }

            if ($isEconomic) {
                $economicScores[] = $normalizedScore;
            }
            if ($isSocial) {
                $socialScores[] = $normalizedScore;
            }
        }

        return [
            'economic' => count($economicScores) > 0
                ? round(array_sum($economicScores) / count($economicScores), 1)
                : 0,
            'social' => count($socialScores) > 0
                ? round(array_sum($socialScores) / count($socialScores), 1)
                : 0,
        ];
    }

    /**
     * Calcular afinidad con cada partido
     */
    private function calculateResults($answers, $parties): array
    {
        $results = [];

        foreach ($parties as $party) {
            $totalScore = 0;
            $maxScore = 0;

            foreach ($answers as $answer) {
                $position = PartyPosition::where('party_id', $party->id)
                    ->where('question_id', $answer->question_id)
                    ->first();

                if ($position) {
                    $diff = abs($answer->answer - $position->position);
                    $importance = $answer->importance ?? 3;

                    $baseScore = pow(4 - $diff, 2);
                    $maxBaseScore = 16;

                    $distanceFromCenter = abs($answer->answer - 3);
                    $convictionFactor = 0.5 + ($distanceFromCenter * 0.25);

                    $weight = $position->weight * $importance * $convictionFactor;

                    $totalScore += $baseScore * $weight;
                    $maxScore += $maxBaseScore * $weight;
                }
            }

            $results[$party->id] = $maxScore > 0 ? round(($totalScore / $maxScore) * 100, 1) : 0;
        }

        arsort($results);

        return [
            'results' => $results,
            'topPartyId' => array_key_first($results),
        ];
    }

    /**
     * Calcular puntuaciones por categoría
     */
    private function calculateCategoryScores($answers, $categories): array
    {
        $scores = [];

        foreach ($categories as $catId => $category) {
            $catAnswers = $answers->filter(fn($a) => $a->question->category_id == $catId);

            if ($catAnswers->count() > 0) {
                $avgAnswer = $catAnswers->avg('answer');
                $scores[$catId] = round((($avgAnswer - 1) / 4) * 100);
            }
        }

        return $scores;
    }
}
