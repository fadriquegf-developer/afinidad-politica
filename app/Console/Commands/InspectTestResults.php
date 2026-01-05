<?php

namespace App\Console\Commands;

use App\Models\TestResult;
use Illuminate\Console\Command;

class InspectTestResults extends Command
{
    protected $signature = 'tests:inspect {id? : ID del test a inspeccionar} {--last=5 : Número de últimos tests a mostrar}';

    protected $description = 'Inspeccionar los valores de category_scores guardados en la BD';

    public function handle()
    {
        $testId = $this->argument('id');

        if ($testId) {
            $this->inspectSingleTest((int) $testId);
        } else {
            $this->inspectLastTests((int) $this->option('last'));
        }

        return 0;
    }

    private function inspectSingleTest(int $testId): void
    {
        $test = TestResult::with('topParty')->find($testId);

        if (!$test) {
            $this->error("Test #{$testId} no encontrado");
            return;
        }

        $this->showTestDetails($test);
    }

    private function inspectLastTests(int $count): void
    {
        $tests = TestResult::with('topParty')
            ->where('is_completed', true)
            ->orderByDesc('completed_at')
            ->limit($count)
            ->get();

        if ($tests->isEmpty()) {
            $this->error("No hay tests completados");
            return;
        }

        foreach ($tests as $test) {
            $this->showTestDetails($test);
            $this->newLine();
            $this->line(str_repeat('-', 60));
            $this->newLine();
        }
    }

    private function showTestDetails(TestResult $test): void
    {
        $this->info("📋 TEST #{$test->id}");
        $this->line("Completado: {$test->completed_at}");
        $this->line("Partido top: " . ($test->topParty?->short_name ?? 'N/A'));
        $this->newLine();

        // Brújula
        $compass = is_array($test->compass_position)
            ? $test->compass_position
            : json_decode($test->compass_position, true);

        $this->info("🧭 BRÚJULA:");
        $this->line("  Económico: " . ($compass['economic'] ?? 'N/A'));
        $this->line("  Social: " . ($compass['social'] ?? 'N/A'));
        $this->newLine();

        // Category Scores
        $categoryScores = is_array($test->category_scores)
            ? $test->category_scores
            : json_decode($test->category_scores, true);

        $this->info("📊 CATEGORY SCORES (deben estar entre -100 y +100):");

        if (empty($categoryScores)) {
            $this->warn("  ⚠️ No hay category_scores guardados");
            return;
        }

        $categories = \App\Models\Category::whereIn('id', array_keys($categoryScores))
            ->get()
            ->keyBy('id');

        $allPositive = true;
        $allNegative = true;
        $hasNegative = false;

        foreach ($categoryScores as $catId => $score) {
            $catName = $categories[$catId]->name ?? "Cat #{$catId}";
            $catIcon = $categories[$catId]->icon ?? '?';

            // Detectar el rango
            if ($score < 0) {
                $hasNegative = true;
                $allPositive = false;
            }
            if ($score > 0) {
                $allNegative = false;
            }

            // Colorear según valor
            if ($score < -10) {
                $indicator = "◀ IZQ";
            } elseif ($score > 10) {
                $indicator = "DER ▶";
            } else {
                $indicator = "CENTRO";
            }

            $this->line(sprintf(
                "  %s %-25s: %+4d  [%s]",
                $catIcon,
                $catName,
                $score,
                $indicator
            ));
        }

        $this->newLine();

        // Diagnóstico
        $minScore = min($categoryScores);
        $maxScore = max($categoryScores);

        $this->info("📈 ANÁLISIS:");
        $this->line("  Valor mínimo: {$minScore}");
        $this->line("  Valor máximo: {$maxScore}");

        if ($minScore >= 0 && $maxScore <= 100) {
            $this->error("  ⚠️ PROBLEMA: Los valores están en rango 0-100 (formato antiguo)");
            $this->error("     Deberían estar en rango -100 a +100");
        } elseif ($minScore >= -100 && $maxScore <= 100 && $hasNegative) {
            $this->line("  ✅ Los valores parecen estar en el rango correcto (-100 a +100)");
        }

        if ($allPositive && $maxScore > 0) {
            $this->warn("  ⚠️ TODOS los valores son positivos (>= 0)");
            $this->warn("     Esto explica por qué todo aparece a la derecha");
        }
    }
}
