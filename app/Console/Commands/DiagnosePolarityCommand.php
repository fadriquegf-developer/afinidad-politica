<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Party;
use App\Models\PartyPosition;
use App\Models\Question;
use Illuminate\Console\Command;

class DiagnosePolarityCommand extends Command
{
    protected $signature = 'tests:diagnose-polarity 
                            {--question= : ID de pregunta específica a analizar}
                            {--category= : Slug de categoría a analizar}';

    protected $description = 'Diagnosticar el cálculo de polaridad de las preguntas';

    private ?array $leftPartyIds = null;
    private ?array $rightPartyIds = null;

    public function handle()
    {
        $this->info('🔍 DIAGNÓSTICO DE POLARIDAD');
        $this->newLine();

        // 1. Verificar partidos de referencia
        $this->checkPartyReferences();

        // 2. Analizar preguntas
        $questionId = $this->option('question');
        $categorySlug = $this->option('category');

        if ($questionId) {
            $this->analyzeQuestion((int) $questionId);
        } elseif ($categorySlug) {
            $this->analyzeCategory($categorySlug);
        } else {
            $this->analyzeAllCategories();
        }

        return 0;
    }

    private function checkPartyReferences(): void
    {
        $this->info('📋 PASO 1: Verificando partidos de referencia...');
        $this->newLine();

        // Partidos que DEBERÍAN existir
        $expectedLeft = ['psoe', 'sumar', 'bildu', 'erc'];
        $expectedRight = ['pp', 'vox', 'alianca-catalana'];

        // Buscar en BD
        $leftParties = Party::whereIn('slug', $expectedLeft)->get();
        $rightParties = Party::whereIn('slug', $expectedRight)->get();

        $this->leftPartyIds = $leftParties->pluck('id')->toArray();
        $this->rightPartyIds = $rightParties->pluck('id')->toArray();

        // Mostrar resultados
        $this->info('Partidos de IZQUIERDA encontrados:');
        if ($leftParties->isEmpty()) {
            $this->error('  ❌ NINGUNO - Esto causará que la polaridad siempre sea 1');
        } else {
            foreach ($leftParties as $p) {
                $this->line("  ✅ {$p->short_name} (slug: {$p->slug}, id: {$p->id})");
            }
        }

        // Verificar cuáles faltan
        $foundLeftSlugs = $leftParties->pluck('slug')->toArray();
        $missingLeft = array_diff($expectedLeft, $foundLeftSlugs);
        if (!empty($missingLeft)) {
            $this->warn('  ⚠️ Faltan: ' . implode(', ', $missingLeft));
        }

        $this->newLine();
        $this->info('Partidos de DERECHA encontrados:');
        if ($rightParties->isEmpty()) {
            $this->error('  ❌ NINGUNO - Esto causará que la polaridad siempre sea 1');
        } else {
            foreach ($rightParties as $p) {
                $this->line("  ✅ {$p->short_name} (slug: {$p->slug}, id: {$p->id})");
            }
        }

        // Verificar cuáles faltan
        $foundRightSlugs = $rightParties->pluck('slug')->toArray();
        $missingRight = array_diff($expectedRight, $foundRightSlugs);
        if (!empty($missingRight)) {
            $this->warn('  ⚠️ Faltan: ' . implode(', ', $missingRight));
        }

        $this->newLine();

        // Mostrar TODOS los partidos en la BD para comparar
        $this->info('📋 Todos los partidos en la BD:');
        $allParties = Party::where('is_active', true)->get();
        foreach ($allParties as $p) {
            $this->line("  - {$p->short_name} (slug: '{$p->slug}', id: {$p->id})");
        }

        $this->newLine();
    }

    private function analyzeQuestion(int $questionId): void
    {
        $question = Question::with('category')->find($questionId);

        if (!$question) {
            $this->error("Pregunta {$questionId} no encontrada");
            return;
        }

        $this->info("📋 PASO 2: Analizando pregunta #{$questionId}");
        $this->newLine();

        $this->line("Categoría: {$question->category->name}");
        $this->line("Texto: {$question->text}");
        $this->newLine();

        $this->showQuestionPolarity($question);
    }

    private function analyzeCategory(string $slug): void
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            $this->error("Categoría '{$slug}' no encontrada");
            return;
        }

        $this->info("📋 PASO 2: Analizando categoría '{$category->name}'");
        $this->newLine();

        $questions = Question::where('category_id', $category->id)
            ->where('is_active', true)
            ->get();

        $polaritySummary = ['left' => 0, 'right' => 0, 'neutral' => 0];

        foreach ($questions as $question) {
            $polarity = $this->showQuestionPolarity($question, false);
            if ($polarity < 0) {
                $polaritySummary['left']++;
            } elseif ($polarity > 0) {
                $polaritySummary['right']++;
            } else {
                $polaritySummary['neutral']++;
            }
        }

        $this->newLine();
        $this->info("📊 Resumen de polaridad en '{$category->name}':");
        $this->line("  Preguntas pro-izquierda: {$polaritySummary['left']}");
        $this->line("  Preguntas pro-derecha: {$polaritySummary['right']}");
        $this->line("  Preguntas neutrales: {$polaritySummary['neutral']}");
    }

    private function analyzeAllCategories(): void
    {
        $this->info('📋 PASO 2: Analizando TODAS las categorías');
        $this->newLine();

        $categories = Category::where('is_active', true)->orderBy('order')->get();

        $results = [];

        foreach ($categories as $category) {
            $questions = Question::where('category_id', $category->id)
                ->where('is_active', true)
                ->get();

            $leftCount = 0;
            $rightCount = 0;
            $neutralCount = 0;

            foreach ($questions as $question) {
                $polarity = $this->calculatePolarity($question->id);
                if ($polarity == -1) {
                    $leftCount++;
                } elseif ($polarity == 1) {
                    $rightCount++;
                } else {
                    $neutralCount++;
                }
            }

            $results[] = [
                'category' => $category->icon . ' ' . $category->name,
                'total' => $questions->count(),
                'left' => $leftCount,
                'right' => $rightCount,
                'neutral' => $neutralCount,
                'balance' => $leftCount - $rightCount,
            ];
        }

        $this->table(
            ['Categoría', 'Total', 'Pro-Izq', 'Pro-Der', 'Neutral', 'Balance'],
            $results
        );

        $this->newLine();

        // Totales
        $totalLeft = array_sum(array_column($results, 'left'));
        $totalRight = array_sum(array_column($results, 'right'));
        $totalNeutral = array_sum(array_column($results, 'neutral'));

        $this->info('📊 RESUMEN GLOBAL:');
        $this->line("  Total preguntas pro-izquierda (polaridad -1): {$totalLeft}");
        $this->line("  Total preguntas pro-derecha (polaridad +1): {$totalRight}");
        $this->line("  Total preguntas neutrales: {$totalNeutral}");

        if ($totalLeft == 0 && $totalRight > 0) {
            $this->error('');
            $this->error('⚠️ PROBLEMA DETECTADO: No hay preguntas con polaridad de izquierda!');
            $this->error('   Esto causará que todos los resultados se sesguen hacia la derecha.');
            $this->error('   Revisa que los partidos de izquierda estén correctamente configurados.');
        }

        if ($totalRight == 0 && $totalLeft > 0) {
            $this->error('');
            $this->error('⚠️ PROBLEMA DETECTADO: No hay preguntas con polaridad de derecha!');
        }
    }

    private function showQuestionPolarity(Question $question, bool $verbose = true): int
    {
        $positions = PartyPosition::where('question_id', $question->id)->get();

        if ($positions->isEmpty()) {
            if ($verbose) {
                $this->warn("  Sin posiciones de partidos");
            }
            return 0;
        }

        $leftSum = 0;
        $leftCount = 0;
        $rightSum = 0;
        $rightCount = 0;
        $leftDetails = [];
        $rightDetails = [];

        foreach ($positions as $pos) {
            $party = Party::find($pos->party_id);
            if (!$party) continue;

            if (in_array($pos->party_id, $this->leftPartyIds)) {
                $leftSum += $pos->position;
                $leftCount++;
                $leftDetails[] = "{$party->short_name}={$pos->position}";
            } elseif (in_array($pos->party_id, $this->rightPartyIds)) {
                $rightSum += $pos->position;
                $rightCount++;
                $rightDetails[] = "{$party->short_name}={$pos->position}";
            }
        }

        $leftAvg = $leftCount > 0 ? round($leftSum / $leftCount, 2) : 3;
        $rightAvg = $rightCount > 0 ? round($rightSum / $rightCount, 2) : 3;

        $polarity = ($leftAvg > $rightAvg) ? -1 : 1;
        $polarityText = $polarity == -1 ? '← IZQUIERDA (-1)' : 'DERECHA (+1) →';
        $polarityColor = $polarity == -1 ? 'red' : 'blue';

        if ($verbose) {
            $this->line("Posiciones IZQUIERDA: " . implode(', ', $leftDetails) . " → Promedio: {$leftAvg}");
            $this->line("Posiciones DERECHA: " . implode(', ', $rightDetails) . " → Promedio: {$rightAvg}");
            $this->newLine();

            if ($leftAvg > $rightAvg) {
                $this->info("✅ Polaridad: {$polarityText}");
                $this->line("   (Responder ALTO = posición de IZQUIERDA)");
            } else {
                $this->info("✅ Polaridad: {$polarityText}");
                $this->line("   (Responder ALTO = posición de DERECHA)");
            }

            $this->newLine();
            $this->line("Ejemplo de cálculo:");
            $this->line("  Si usuario responde 5: score = ((5-3)/2)*100*{$polarity} = " . ((5 - 3) / 2 * 100 * $polarity));
            $this->line("  Si usuario responde 1: score = ((1-3)/2)*100*{$polarity} = " . ((1 - 3) / 2 * 100 * $polarity));
        } else {
            $shortText = substr($question->text, 0, 50) . '...';
            $this->line("  [{$polarity}] {$shortText}");
        }

        return $polarity;
    }

    private function calculatePolarity(int $questionId): int
    {
        $positions = PartyPosition::where('question_id', $questionId)->get();

        if ($positions->isEmpty()) {
            return 0;
        }

        $leftSum = 0;
        $leftCount = 0;
        $rightSum = 0;
        $rightCount = 0;

        foreach ($positions as $pos) {
            if (in_array($pos->party_id, $this->leftPartyIds)) {
                $leftSum += $pos->position;
                $leftCount++;
            } elseif (in_array($pos->party_id, $this->rightPartyIds)) {
                $rightSum += $pos->position;
                $rightCount++;
            }
        }

        $leftAvg = $leftCount > 0 ? $leftSum / $leftCount : 3;
        $rightAvg = $rightCount > 0 ? $rightSum / $rightCount : 3;

        return ($leftAvg > $rightAvg) ? -1 : 1;
    }
}
