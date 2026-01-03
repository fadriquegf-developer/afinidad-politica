<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Party;
use App\Models\Question;
use App\Models\TestResult;
use App\Models\TestAnswer;
use App\Models\PartyPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index()
    {
        $totalQuestions = Question::where('is_active', true)->count();
        $categories = Category::where('is_active', true)
            ->withCount(['questions' => fn($q) => $q->where('is_active', true)])
            ->orderBy('order')
            ->get();

        $parties = Party::where('is_active', true)->orderBy('order')->get();
        $estimatedMinutes = ceil($totalQuestions * 6 / 60);

        return view('test.index', compact('categories', 'parties', 'totalQuestions', 'estimatedMinutes'));
    }

    public function start(Request $request)
    {
        $testResult = TestResult::create([
            'session_id' => Str::uuid(),
            'share_id' => $this->generateShareId(),
            'ip_hash' => hash('sha256', $request->ip()),
            'user_agent' => $request->userAgent(),
        ]);

        $questions = Question::where('questions.is_active', true)
            ->join('categories', 'questions.category_id', '=', 'categories.id')
            ->where('categories.is_active', true)
            ->orderBy('categories.order')
            ->orderBy('questions.order')
            ->select('questions.*')
            ->get();

        session([
            'test_id' => $testResult->id,
            'test_questions' => $questions->pluck('id')->toArray()
        ]);

        return redirect()->route('test.question', 1);
    }

    private function generateShareId(): string
    {
        do {
            $shareId = Str::random(10);
        } while (TestResult::where('share_id', $shareId)->exists());

        return $shareId;
    }

    public function question($number)
    {
        $testId = session('test_id');
        $questionIds = session('test_questions');

        if (!$testId || !$questionIds) {
            return redirect()->route('test.index');
        }

        $total = count($questionIds);
        $index = $number - 1;

        if ($index < 0 || $index >= $total) {
            return redirect()->route('test.results');
        }

        $question = Question::with('category')->findOrFail($questionIds[$index]);
        $category = $question->category;

        $existingAnswer = TestAnswer::where('test_result_id', $testId)
            ->where('question_id', $question->id)
            ->first();

        $answeredCount = TestAnswer::where('test_result_id', $testId)->count();

        return view('test.question', compact('question', 'category', 'number', 'total', 'existingAnswer', 'answeredCount'));
    }

    public function answer(Request $request, $number)
    {
        $testId = session('test_id');
        $questionIds = session('test_questions');

        if (!$testId || !$questionIds) {
            return redirect()->route('test.index');
        }

        $request->validate([
            'answer' => 'required|integer|min:0|max:5',
        ]);

        $index = $number - 1;
        $questionId = $questionIds[$index];

        if ($request->answer == 0) {
            TestAnswer::where('test_result_id', $testId)
                ->where('question_id', $questionId)
                ->delete();
        } else {
            TestAnswer::updateOrCreate(
                ['test_result_id' => $testId, 'question_id' => $questionId],
                ['answer' => $request->answer, 'importance' => $request->importance ?? 3]
            );
        }

        $total = count($questionIds);

        if ($number >= $total) {
            return redirect()->route('test.results');
        }

        return redirect()->route('test.question', $number + 1);
    }

    public function results()
    {
        $testId = session('test_id');
        if (!$testId) {
            return redirect()->route('test.index');
        }

        $testResult = TestResult::findOrFail($testId);

        if ($testResult->is_completed && $testResult->share_id) {
            return redirect()->route('test.shared', $testResult->share_id);
        }

        $answers = $testResult->answers()->with('question.category')->get();

        if ($answers->isEmpty()) {
            return redirect()->route('test.index');
        }

        $resultsData = $this->calculateResults($answers);
        $compassPosition = $this->calculateCompassPosition($answers);
        $categoryScores = $this->calculateCategoryScores($answers);

        $testResult->update([
            'results' => $resultsData['results'],
            'compass_position' => $compassPosition,
            'category_scores' => $categoryScores,
            'top_party_id' => $resultsData['topPartyId'],
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return redirect()->route('test.shared', $testResult->share_id);
    }

    /**
     * Mostrar resultados por URL compartible (pública)
     */
    public function shared($shareId)
    {
        $testResult = TestResult::where('share_id', $shareId)
            ->where('is_completed', true)
            ->firstOrFail();

        $results = is_array($testResult->results)
            ? $testResult->results
            : json_decode($testResult->results, true);

        $compassPosition = is_array($testResult->compass_position)
            ? $testResult->compass_position
            : json_decode($testResult->compass_position, true);

        $categoryScores = is_array($testResult->category_scores)
            ? $testResult->category_scores
            : json_decode($testResult->category_scores, true);

        $parties = Party::where('is_active', true)->get()->keyBy('id');
        $categories = Category::where('is_active', true)->orderBy('order')->get()->keyBy('id');

        arsort($results);

        $answers = $testResult->answers()->with('question.category')->get();
        $partyMatches = $this->getPartyMatches($answers, $parties);
        $resultsByCategory = $this->getResultsByCategory($answers, $parties, $categories);

        $answeredCount = $answers->count();
        $totalQuestions = Question::where('is_active', true)->count();

        // Datos para Open Graph
        $topPartyId = array_key_first($results);
        $ogData = [
            'party_name' => $parties[$topPartyId]->name ?? 'Desconocido',
            'party_short' => $parties[$topPartyId]->short_name ?? '?',
            'score' => $results[$topPartyId] ?? 0,
            'compass_x' => $compassPosition['economic'] ?? 0,
            'compass_y' => $compassPosition['social'] ?? 0,
        ];

        return view('test.results', compact(
            'testResult',
            'results',
            'parties',
            'categories',
            'partyMatches',
            'resultsByCategory',
            'compassPosition',
            'categoryScores',
            'answeredCount',
            'totalQuestions',
            'shareId',
            'ogData'
        ));
    }

    /**
     * Comparador de dos resultados
     */
    public function compare($shareId1, $shareId2 = null)
    {
        $test1 = TestResult::where('share_id', $shareId1)
            ->where('is_completed', true)
            ->firstOrFail();

        $test2 = null;
        if ($shareId2) {
            $test2 = TestResult::where('share_id', $shareId2)
                ->where('is_completed', true)
                ->first();
        }

        $parties = Party::where('is_active', true)->get()->keyBy('id');
        $categories = Category::where('is_active', true)->orderBy('order')->get();

        // Procesar datos del test 1
        $results1 = is_array($test1->results) ? $test1->results : json_decode($test1->results, true);
        $compass1 = is_array($test1->compass_position) ? $test1->compass_position : json_decode($test1->compass_position, true);
        $categoryScores1 = is_array($test1->category_scores) ? $test1->category_scores : json_decode($test1->category_scores, true);
        arsort($results1);
        $topParty1 = $parties[array_key_first($results1)] ?? null;

        $data1 = [
            'shareId' => $shareId1,
            'results' => $results1,
            'compass' => $compass1,
            'categoryScores' => $categoryScores1,
            'topParty' => $topParty1,
            'topScore' => $results1[array_key_first($results1)] ?? 0,
        ];

        $data2 = null;
        $compatibility = null;

        if ($test2) {
            $results2 = is_array($test2->results) ? $test2->results : json_decode($test2->results, true);
            $compass2 = is_array($test2->compass_position) ? $test2->compass_position : json_decode($test2->compass_position, true);
            $categoryScores2 = is_array($test2->category_scores) ? $test2->category_scores : json_decode($test2->category_scores, true);
            arsort($results2);
            $topParty2 = $parties[array_key_first($results2)] ?? null;

            $data2 = [
                'shareId' => $shareId2,
                'results' => $results2,
                'compass' => $compass2,
                'categoryScores' => $categoryScores2,
                'topParty' => $topParty2,
                'topScore' => $results2[array_key_first($results2)] ?? 0,
            ];

            // Calcular compatibilidad
            $compatibility = $this->calculateCompatibility($compass1, $compass2, $categoryScores1, $categoryScores2);
        }

        return view('test.compare', compact(
            'data1',
            'data2',
            'parties',
            'categories',
            'compatibility',
            'shareId1',
            'shareId2'
        ));
    }

    /**
     * Calcular compatibilidad entre dos usuarios
     */
    private function calculateCompatibility($compass1, $compass2, $cats1, $cats2): array
    {
        // Distancia en la brújula (0-100, donde 100 = idénticos)
        $dx = ($compass1['economic'] ?? 0) - ($compass2['economic'] ?? 0);
        $dy = ($compass1['social'] ?? 0) - ($compass2['social'] ?? 0);
        $distance = sqrt($dx * $dx + $dy * $dy);
        $maxDistance = sqrt(200 * 200 + 200 * 200); // Diagonal máxima
        $compassCompatibility = round((1 - ($distance / $maxDistance)) * 100);

        // Similitud por categorías
        $categoryDiffs = [];
        $totalDiff = 0;
        $count = 0;

        foreach ($cats1 ?? [] as $catId => $score1) {
            $score2 = $cats2[$catId] ?? 50;
            $diff = abs($score1 - $score2);
            $categoryDiffs[$catId] = 100 - $diff;
            $totalDiff += $diff;
            $count++;
        }

        $categoryCompatibility = $count > 0 ? round(100 - ($totalDiff / $count)) : 50;

        // Puntuación global (promedio ponderado)
        $overall = round(($compassCompatibility * 0.4) + ($categoryCompatibility * 0.6));

        // Determinar nivel
        $level = match (true) {
            $overall >= 80 => ['text' => '¡Muy compatibles!', 'emoji' => '💚', 'class' => 'success'],
            $overall >= 60 => ['text' => 'Bastante compatibles', 'emoji' => '💛', 'class' => 'warning'],
            $overall >= 40 => ['text' => 'Algunas diferencias', 'emoji' => '🧡', 'class' => 'info'],
            default => ['text' => 'Visiones distintas', 'emoji' => '💜', 'class' => 'secondary'],
        };

        return [
            'overall' => $overall,
            'compass' => $compassCompatibility,
            'categories' => $categoryCompatibility,
            'categoryDetails' => $categoryDiffs,
            'level' => $level,
        ];
    }

    /**
     * Calcular puntuaciones por categoría (para el radar)
     */
    private function calculateCategoryScores($answers): array
    {
        $categories = Category::where('is_active', true)->get()->keyBy('id');
        $scores = [];

        foreach ($categories as $catId => $category) {
            $catAnswers = $answers->filter(fn($a) => $a->question->category_id == $catId);

            if ($catAnswers->count() > 0) {
                // Convertir respuestas 1-5 a escala 0-100
                $avgAnswer = $catAnswers->avg('answer');
                $scores[$catId] = round((($avgAnswer - 1) / 4) * 100);
            }
        }

        return $scores;
    }

    private function calculateResults($answers): array
    {
        $parties = Party::where('is_active', true)->get();
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
                    $weight = $position->weight * $importance;

                    $totalScore += (4 - $diff) * $weight;
                    $maxScore += 4 * $weight;
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

    private function calculateCompassPosition($answers): array
    {
        $economicCategories = [
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

        $socialCategories = [
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

            foreach ($economicCategories as $ec) {
                if (str_contains($categoryName, $ec) || str_contains($categorySlug, $ec)) {
                    $isEconomic = true;
                    break;
                }
            }

            foreach ($socialCategories as $sc) {
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

        $economicPosition = count($economicScores) > 0
            ? round(array_sum($economicScores) / count($economicScores), 1)
            : 0;

        $socialPosition = count($socialScores) > 0
            ? round(array_sum($socialScores) / count($socialScores), 1)
            : 0;

        return [
            'economic' => $economicPosition,
            'social' => $socialPosition,
        ];
    }

    private function getPartyMatches($answers, $parties): array
    {
        $partyMatches = [];

        foreach ($parties as $party) {
            $matches = [];
            $divergences = [];

            foreach ($answers as $answer) {
                $position = PartyPosition::where('party_id', $party->id)
                    ->where('question_id', $answer->question_id)
                    ->first();

                if ($position) {
                    $diff = abs($answer->answer - $position->position);
                    $matchPercent = round((4 - $diff) / 4 * 100);

                    $questionData = [
                        'question' => $answer->question->text,
                        'category' => $answer->question->category->name ?? '-',
                        'user_answer' => $answer->answer,
                        'party_position' => $position->position,
                        'match_percent' => $matchPercent,
                    ];

                    if ($diff <= 1) {
                        $matches[] = $questionData;
                    } elseif ($diff >= 3) {
                        $divergences[] = $questionData;
                    }
                }
            }

            usort($matches, fn($a, $b) => $b['match_percent'] <=> $a['match_percent']);
            usort($divergences, fn($a, $b) => $a['match_percent'] <=> $b['match_percent']);

            $partyMatches[$party->id] = [
                'matches' => array_slice($matches, 0, 5),
                'divergences' => array_slice($divergences, 0, 5)
            ];
        }

        return $partyMatches;
    }

    private function getResultsByCategory($answers, $parties, $categories): array
    {
        $resultsByCategory = [];

        foreach ($parties as $party) {
            foreach ($answers as $answer) {
                $catId = $answer->question->category_id;

                $position = PartyPosition::where('party_id', $party->id)
                    ->where('question_id', $answer->question_id)
                    ->first();

                if ($position) {
                    if (!isset($resultsByCategory[$catId])) {
                        $resultsByCategory[$catId] = [];
                    }
                    if (!isset($resultsByCategory[$catId][$party->id])) {
                        $resultsByCategory[$catId][$party->id] = ['score' => 0, 'max' => 0];
                    }

                    $diff = abs($answer->answer - $position->position);
                    $resultsByCategory[$catId][$party->id]['score'] += (4 - $diff);
                    $resultsByCategory[$catId][$party->id]['max'] += 4;
                }
            }
        }

        foreach ($resultsByCategory as $catId => $partyScores) {
            foreach ($partyScores as $partyId => $scores) {
                $resultsByCategory[$catId][$partyId] = $scores['max'] > 0
                    ? round(($scores['score'] / $scores['max']) * 100, 1)
                    : 0;
            }
        }

        return $resultsByCategory;
    }

    public function restart()
    {
        session()->forget(['test_id', 'test_questions']);
        return redirect()->route('test.index');
    }
}
