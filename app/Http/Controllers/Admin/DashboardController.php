<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Party;
use App\Models\Question;
use App\Models\TestAnswer;
use App\Models\TestResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = $this->getGeneralStats();

        // Tests por día (últimos 30 días)
        $testsPerDay = $this->getTestsPerDay();

        // Distribución por partido ganador
        $partyDistribution = $this->getPartyDistribution();

        // Preguntas más polémicas (mayor varianza)
        $controversialQuestions = $this->getControversialQuestions();

        // Preguntas más saltadas
        $skippedQuestions = $this->getSkippedQuestions();

        // Distribución de respuestas por categoría
        $categoryStats = $this->getCategoryStats();

        // Tests recientes
        $recentTests = $this->getRecentTests();

        // Tasa de abandono por pregunta
        $dropoffByQuestion = $this->getDropoffByQuestion();

        return view('admin.dashboard', compact(
            'stats',
            'testsPerDay',
            'partyDistribution',
            'controversialQuestions',
            'skippedQuestions',
            'categoryStats',
            'recentTests',
            'dropoffByQuestion'
        ));
    }

    private function getGeneralStats(): array
    {
        $totalTests = TestResult::count();
        $completedTests = TestResult::where('is_completed', true)->count();
        $abandonedTests = $totalTests - $completedTests;
        $completionRate = $totalTests > 0 ? round(($completedTests / $totalTests) * 100, 1) : 0;

        $totalAnswers = TestAnswer::count();
        $avgAnswersPerTest = $completedTests > 0
            ? round(TestAnswer::whereHas('testResult', fn($q) => $q->where('is_completed', true))->count() / $completedTests, 1)
            : 0;

        $totalQuestions = Question::where('is_active', true)->count();

        // Tests de hoy
        $testsToday = TestResult::whereDate('created_at', Carbon::today())->count();
        $completedToday = TestResult::whereDate('created_at', Carbon::today())->where('is_completed', true)->count();

        // Tests esta semana
        $testsThisWeek = TestResult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()])->count();

        // Promedio de afinidad del partido ganador
        $avgTopAffinity = TestResult::where('is_completed', true)
            ->whereNotNull('results')
            ->get()
            ->map(function ($test) {
                $results = is_array($test->results) ? $test->results : json_decode($test->results, true);
                return $results ? max($results) : 0;
            })
            ->avg();
        $avgTopAffinity = round($avgTopAffinity ?? 0, 1);

        return [
            'total_tests' => $totalTests,
            'completed_tests' => $completedTests,
            'abandoned_tests' => $abandonedTests,
            'completion_rate' => $completionRate,
            'total_answers' => $totalAnswers,
            'avg_answers_per_test' => $avgAnswersPerTest,
            'total_questions' => $totalQuestions,
            'tests_today' => $testsToday,
            'completed_today' => $completedToday,
            'tests_this_week' => $testsThisWeek,
            'avg_top_affinity' => $avgTopAffinity,
        ];
    }

    private function getTestsPerDay(): array
    {
        $days = []; // Usar array en lugar de collect()

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $days[$date] = [
                'date' => Carbon::now()->subDays($i)->format('d/m'),
                'total' => 0,
                'completed' => 0,
            ];
        }

        $tests = TestResult::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN is_completed = 1 THEN 1 ELSE 0 END) as completed')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->get();

        foreach ($tests as $test) {
            if (isset($days[$test->date])) {
                $days[$test->date]['total'] = $test->total;
                $days[$test->date]['completed'] = $test->completed;
            }
        }

        return array_values($days); // Convertir a array indexado
    }

    private function getPartyDistribution(): array
    {
        $parties = Party::where('is_active', true)->get()->keyBy('id');

        $distribution = TestResult::where('is_completed', true)
            ->whereNotNull('top_party_id')
            ->select('top_party_id', DB::raw('COUNT(*) as count'))
            ->groupBy('top_party_id')
            ->orderByDesc('count')
            ->get();

        return $distribution->map(function ($item) use ($parties) {
            $party = $parties[$item->top_party_id] ?? null;
            return [
                'party_id' => $item->top_party_id,
                'party_name' => $party?->name ?? 'Desconocido',
                'short_name' => $party?->short_name ?? '?',
                'color' => $party?->color ?? '#ccc',
                'count' => $item->count,
            ];
        })->toArray();
    }

    private function getControversialQuestions(): array
    {
        // Preguntas con mayor varianza en las respuestas (más polémicas)
        $questions = Question::where('is_active', true)
            ->with('category')
            ->withCount('answers')
            ->get()
            ->map(function ($question) {
                $answers = TestAnswer::where('question_id', $question->id)
                    ->where('answer', '>', 0) // Excluir "No sé"
                    ->pluck('answer');

                if ($answers->count() < 5) {
                    return null;
                }

                $mean = $answers->avg();
                $variance = $answers->map(fn($a) => pow($a - $mean, 2))->avg();

                // Distribución de respuestas
                $distribution = $answers->countBy()->toArray();

                return [
                    'id' => $question->id,
                    'text' => \Str::limit($question->text, 80),
                    'category' => $question->category->name ?? '-',
                    'category_color' => $question->category->color ?? '#ccc',
                    'answers_count' => $answers->count(),
                    'mean' => round($mean, 2),
                    'variance' => round($variance, 2),
                    'distribution' => $distribution,
                ];
            })
            ->filter()
            ->sortByDesc('variance')
            ->take(10)
            ->values()
            ->toArray();

        return $questions;
    }

    private function getSkippedQuestions(): array
    {
        // Preguntas más saltadas (answer = 0 o sin respuesta)
        $totalCompletedTests = TestResult::where('is_completed', true)->count();

        if ($totalCompletedTests == 0) {
            return [];
        }

        $questions = Question::where('is_active', true)
            ->with('category')
            ->get()
            ->map(function ($question) use ($totalCompletedTests) {
                $answeredCount = TestAnswer::where('question_id', $question->id)
                    ->where('answer', '>', 0)
                    ->whereHas('testResult', fn($q) => $q->where('is_completed', true))
                    ->count();

                $skippedCount = $totalCompletedTests - $answeredCount;
                $skipRate = round(($skippedCount / $totalCompletedTests) * 100, 1);

                return [
                    'id' => $question->id,
                    'text' => \Str::limit($question->text, 80),
                    'category' => $question->category->name ?? '-',
                    'skip_rate' => $skipRate,
                    'skipped_count' => $skippedCount,
                ];
            })
            ->sortByDesc('skip_rate')
            ->take(10)
            ->values()
            ->toArray();

        return $questions;
    }

    private function getCategoryStats(): array
    {
        $categories = Category::where('is_active', true)
            ->with(['questions' => fn($q) => $q->where('is_active', true)])
            ->orderBy('order')
            ->get();

        return $categories->map(function ($category) {
            $questionIds = $category->questions->pluck('id');

            $answers = TestAnswer::whereIn('question_id', $questionIds)
                ->where('answer', '>', 0)
                ->get();

            $avgAnswer = $answers->avg('answer');
            $distribution = $answers->countBy('answer')->toArray();

            // Calcular tendencia (1-2 = izquierda, 4-5 = derecha, 3 = centro)
            $leftCount = $answers->whereIn('answer', [1, 2])->count();
            $rightCount = $answers->whereIn('answer', [4, 5])->count();
            $centerCount = $answers->where('answer', 3)->count();
            $total = $answers->count();

            return [
                'id' => $category->id,
                'name' => $category->name,
                'icon' => $category->icon,
                'color' => $category->color,
                'questions_count' => $category->questions->count(),
                'answers_count' => $answers->count(),
                'avg_answer' => round($avgAnswer ?? 0, 2),
                'distribution' => $distribution,
                'left_percent' => $total > 0 ? round(($leftCount / $total) * 100, 1) : 0,
                'center_percent' => $total > 0 ? round(($centerCount / $total) * 100, 1) : 0,
                'right_percent' => $total > 0 ? round(($rightCount / $total) * 100, 1) : 0,
            ];
        })->toArray();
    }

    private function getRecentTests(): array
    {
        return TestResult::with('topParty')
            ->where('is_completed', true)
            ->orderByDesc('completed_at')
            ->take(10)
            ->get()
            ->map(function ($test) {
                $results = is_array($test->results) ? $test->results : json_decode($test->results, true);
                $topScore = $results ? max($results) : 0;

                return [
                    'id' => $test->id,
                    'completed_at' => $test->completed_at?->format('d/m/Y H:i'),
                    'party_name' => $test->topParty?->short_name ?? '-',
                    'party_color' => $test->topParty?->color ?? '#ccc',
                    'top_score' => round($topScore, 1),
                    'answers_count' => $test->answers()->count(),
                ];
            })
            ->toArray();
    }

    private function getDropoffByQuestion(): array
    {
        // En qué pregunta abandonan los usuarios
        $abandonedTests = TestResult::where('is_completed', false)
            ->whereHas('answers')
            ->get();

        $dropoffCounts = [];

        foreach ($abandonedTests as $test) {
            $lastAnswerOrder = $test->answers()->count();
            if (!isset($dropoffCounts[$lastAnswerOrder])) {
                $dropoffCounts[$lastAnswerOrder] = 0;
            }
            $dropoffCounts[$lastAnswerOrder]++;
        }

        ksort($dropoffCounts);

        return array_map(function ($question, $count) {
            return [
                'question_number' => $question,
                'dropoff_count' => $count,
            ];
        }, array_keys($dropoffCounts), array_values($dropoffCounts));
    }

    /**
     * API endpoint para obtener datos actualizados (para AJAX)
     */
    public function apiStats()
    {
        return response()->json([
            'stats' => $this->getGeneralStats(),
            'partyDistribution' => $this->getPartyDistribution(),
        ]);
    }
}
