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

        // Si ya está completado, redirigir a la URL compartible
        if ($testResult->is_completed && $testResult->share_id) {
            return redirect()->route('test.shared', $testResult->share_id);
        }

        $answers = $testResult->answers()->with('question.category')->get();

        if ($answers->isEmpty()) {
            return redirect()->route('test.index');
        }

        // Calcular resultados
        $resultsData = $this->calculateResults($answers);

        // Calcular posición en brújula política
        $compassPosition = $this->calculateCompassPosition($answers);

        // Guardar resultados
        $testResult->update([
            'results' => $resultsData['results'],
            'compass_position' => $compassPosition,
            'top_party_id' => $resultsData['topPartyId'],
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        // Redirigir a URL compartible
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

        $parties = Party::where('is_active', true)->get()->keyBy('id');
        $categories = Category::where('is_active', true)->orderBy('order')->get()->keyBy('id');

        // Ordenar resultados
        arsort($results);

        // Obtener detalles de coincidencias/divergencias
        $answers = $testResult->answers()->with('question.category')->get();
        $partyMatches = $this->getPartyMatches($answers, $parties);
        $resultsByCategory = $this->getResultsByCategory($answers, $parties, $categories);

        $answeredCount = $answers->count();
        $totalQuestions = Question::where('is_active', true)->count();

        return view('test.results', compact(
            'testResult',
            'results',
            'parties',
            'categories',
            'partyMatches',
            'resultsByCategory',
            'compassPosition',
            'answeredCount',
            'totalQuestions',
            'shareId'
        ));
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

    /**
     * Calcular posición en la brújula política
     * Eje X: Izquierda económica (-100) a Derecha económica (+100)
     * Eje Y: Conservador/Autoritario (-100) a Progresista/Libertario (+100)
     */
    private function calculateCompassPosition($answers): array
    {
        // Mapeo de categorías a ejes (ajustar según tus categorías)
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
            'medioambiente'
        ];

        $economicScores = [];
        $socialScores = [];

        foreach ($answers as $answer) {
            if (!$answer->question || !$answer->question->category) {
                continue;
            }

            $categoryName = strtolower($answer->question->category->name);
            $categorySlug = strtolower($answer->question->category->slug ?? '');

            // Convertir respuesta 1-5 a escala -100 a +100
            // 1 = -100 (muy izquierda/conservador)
            // 3 = 0 (centro)
            // 5 = +100 (muy derecha/progresista)
            $normalizedScore = (($answer->answer - 3) / 2) * 100;

            // Determinar a qué eje pertenece
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

            // Si no encaja en ninguno, contar para ambos
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

        // Calcular medias
        $economicPosition = count($economicScores) > 0
            ? round(array_sum($economicScores) / count($economicScores), 1)
            : 0;

        $socialPosition = count($socialScores) > 0
            ? round(array_sum($socialScores) / count($socialScores), 1)
            : 0;

        return [
            'economic' => $economicPosition,  // Eje X: - izquierda, + derecha
            'social' => $socialPosition,      // Eje Y: - conservador, + progresista
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

        // Convertir a porcentajes
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
