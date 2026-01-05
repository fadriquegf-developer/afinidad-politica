<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Party;
use App\Models\PartyPosition;
use App\Models\TestResult;
use Illuminate\Console\Command;

class RecalculateTestResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests:recalculate 
                            {--dry-run : Simular sin guardar cambios}
                            {--limit= : Limitar número de tests a procesar}
                            {--id= : Recalcular solo un test específico por ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalcular los resultados de todos los tests completados usando el algoritmo mejorado';

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
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        $limit = $this->option('limit');
        $specificId = $this->option('id');

        if ($dryRun) {
            $this->warn('🔍 MODO DRY-RUN: No se guardarán cambios');
            $this->newLine();
        }

        // Obtener tests a procesar
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

        $this->info("📊 Recalculando {$total} tests con el algoritmo mejorado...");
        $this->newLine();

        // Cargar datos necesarios
        $parties = Party::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get()->keyBy('id');

        // Estadísticas
        $stats = [
            'processed' => 0,
            'changed' => 0,
            'unchanged' => 0,
            'errors' => 0,
            'top_party_changes' => 0,
            'avg_difference' => [],
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

                // Guardar resultados antiguos para comparar
                $oldResults = is_array($test->results)
                    ? $test->results
                    : json_decode($test->results, true);
                $oldTopPartyId = $test->top_party_id;

                // Calcular nuevos resultados
                $newResultsData = $this->calculateResults($answers, $parties);
                $newCompassPosition = $this->calculateCompassPosition($answers);
                $newCategoryScores = $this->calculateCategoryScores($answers, $categories);

                // Comparar cambios
                $hasChanged = false;
                $differences = [];

                foreach ($newResultsData['results'] as $partyId => $newScore) {
                    $oldScore = $oldResults[$partyId] ?? 0;
                    $diff = abs($newScore - $oldScore);

                    if ($diff > 0.1) {
                        $hasChanged = true;
                        $differences[$partyId] = [
                            'old' => $oldScore,
                            'new' => $newScore,
                            'diff' => round($newScore - $oldScore, 1),
                        ];
                        $stats['avg_difference'][] = $diff;
                    }
                }

                // Verificar cambio de partido top
                $topPartyChanged = $oldTopPartyId != $newResultsData['topPartyId'];
                if ($topPartyChanged) {
                    $stats['top_party_changes']++;
                }

                if ($hasChanged) {
                    $stats['changed']++;

                    if (!$dryRun) {
                        $test->update([
                            'results' => $newResultsData['results'],
                            'compass_position' => $newCompassPosition,
                            'category_scores' => $newCategoryScores,
                            'top_party_id' => $newResultsData['topPartyId'],
                        ]);
                    }
                } else {
                    $stats['unchanged']++;
                }

                $stats['processed']++;
            } catch (\Exception $e) {
                $stats['errors']++;
                $this->newLine();
                $this->error("Error en test #{$test->id}: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Mostrar estadísticas
        $this->displayStats($stats, $dryRun);

        return 0;
    }

    /**
     * Calcular afinidad con cada partido (algoritmo mejorado)
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

                    // MEJORA 1: Escala cuadrática
                    $baseScore = pow(4 - $diff, 2);
                    $maxBaseScore = 16;

                    // MEJORA 2: Factor de convicción
                    $distanceFromCenter = abs($answer->answer - 3);
                    $convictionFactor = 0.5 + ($distanceFromCenter * 0.25);

                    // Peso final combinado
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
     * Calcular posición en la brújula política
     */
    private function calculateCompassPosition($answers): array
    {
        $economicScores = [];
        $socialScores = [];

        foreach ($answers as $answer) {
            if (!$answer->question || !$answer->question->category) {
                continue;
            }

            $categoryName = strtolower($answer->question->category->name);
            $categorySlug = strtolower($answer->question->category->slug ?? '');

            $normalizedScore = (($answer->answer - 3) / 2) * 100;

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

    /**
     * Mostrar estadísticas finales
     */
    private function displayStats(array $stats, bool $dryRun): void
    {
        $this->info('═══════════════════════════════════════════');
        $this->info('              RESUMEN DE RECÁLCULO          ');
        $this->info('═══════════════════════════════════════════');
        $this->newLine();

        $this->line("  📊 Tests procesados:     <info>{$stats['processed']}</info>");
        $this->line("  ✅ Tests modificados:    <info>{$stats['changed']}</info>");
        $this->line("  ➖ Tests sin cambios:    <comment>{$stats['unchanged']}</comment>");
        $this->line("  ❌ Errores:              <error>{$stats['errors']}</error>");
        $this->newLine();

        $this->line("  🔄 Cambios de partido principal: <info>{$stats['top_party_changes']}</info>");

        if (count($stats['avg_difference']) > 0) {
            $avgDiff = round(array_sum($stats['avg_difference']) / count($stats['avg_difference']), 2);
            $maxDiff = round(max($stats['avg_difference']), 2);
            $this->line("  📈 Diferencia media:     <info>{$avgDiff}%</info>");
            $this->line("  📈 Diferencia máxima:    <info>{$maxDiff}%</info>");
        }

        $this->newLine();

        if ($dryRun) {
            $this->warn('⚠️  MODO DRY-RUN: No se guardaron cambios.');
            $this->info('   Ejecuta sin --dry-run para aplicar los cambios.');
        } else {
            $this->info('✅ Todos los cambios han sido guardados.');
        }

        $this->newLine();
    }
}
