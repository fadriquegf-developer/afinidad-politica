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
        $categories = Category::where('is_active', true)
            ->withCount(['questions' => fn($q) => $q->where('is_active', true)])
            ->orderBy('order')
            ->get();

        $totalQuestions = $categories->sum('questions_count');
        $parties = Party::where('is_active', true)->orderBy('order')->get();

        return view('test.index', compact('categories', 'totalQuestions', 'parties'));
    }

    public function start(Request $request)
    {
        $sessionId = Str::uuid();

        $testResult = TestResult::create([
            'session_id' => $sessionId,
            'ip_hash' => hash('sha256', $request->ip()),
            'user_agent' => $request->userAgent(),
        ]);

        session(['test_id' => $testResult->id]);

        return redirect()->route('test.question', 1);
    }

    public function question($number)
    {
        $testId = session('test_id');
        if (!$testId) {
            return redirect()->route('test.index');
        }

        $questions = Question::where('is_active', true)
            ->orderBy('category_id')
            ->orderBy('order')
            ->get();

        $total = $questions->count();
        $index = $number - 1;

        if ($index < 0 || $index >= $total) {
            return redirect()->route('test.results');
        }

        $question = $questions[$index];
        $category = $question->category;

        // Verificar si ya fue respondida
        $existingAnswer = TestAnswer::where('test_result_id', $testId)
            ->where('question_id', $question->id)
            ->first();

        return view('test.question', compact('question', 'category', 'number', 'total', 'existingAnswer'));
    }

    public function answer(Request $request, $number)
    {
        $testId = session('test_id');
        if (!$testId) {
            return redirect()->route('test.index');
        }

        $request->validate([
            'answer' => 'required|integer|min:1|max:5',
            'importance' => 'integer|min:1|max:5',
        ]);

        $questions = Question::where('is_active', true)
            ->orderBy('category_id')
            ->orderBy('order')
            ->get();

        $index = $number - 1;
        $question = $questions[$index];

        TestAnswer::updateOrCreate(
            ['test_result_id' => $testId, 'question_id' => $question->id],
            ['answer' => $request->answer, 'importance' => $request->importance ?? 3]
        );

        $total = $questions->count();

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
        $answers = $testResult->answers()->with('question')->get();

        if ($answers->isEmpty()) {
            return redirect()->route('test.index');
        }

        // Calcular afinidad con cada partido
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
                    $weight = $answer->importance * $position->weight;
                    $totalScore += (4 - $diff) * $weight;
                    $maxScore += 4 * $weight;
                }
            }

            $results[$party->id] = $maxScore > 0 ? round(($totalScore / $maxScore) * 100, 1) : 0;
        }

        arsort($results);

        // Guardar resultados
        $topPartyId = array_key_first($results);
        $testResult->update([
            'results' => $results,
            'top_party_id' => $topPartyId,
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        $parties = $parties->keyBy('id');

        return view('test.results', compact('results', 'parties', 'testResult'));
    }

    public function restart()
    {
        session()->forget('test_id');
        return redirect()->route('test.index');
    }
}
