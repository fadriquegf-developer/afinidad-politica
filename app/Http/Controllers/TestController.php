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

        $parties = Party::where('is_active', true)->orderBy('order')->get();

        return view('test.index', compact('categories', 'parties'));
    }

    public function start(Request $request)
    {
        $request->validate([
            'mode' => 'required|integer|min:1|max:3'
        ]);

        $sessionId = Str::uuid();
        $mode = $request->mode;

        $testResult = TestResult::create([
            'session_id' => $sessionId,
            'ip_hash' => hash('sha256', $request->ip()),
            'user_agent' => $request->userAgent(),
        ]);

        // Seleccionar preguntas según modo
        $questions = $this->getQuestionsForMode($mode);

        session([
            'test_id' => $testResult->id,
            'test_mode' => $mode,
            'test_questions' => $questions->pluck('id')->toArray()
        ]);

        return redirect()->route('test.question', 1);
    }

    private function getQuestionsForMode(int $mode)
    {
        $categories = Category::where('is_active', true)->orderBy('order')->get();
        $questions = collect();

        foreach ($categories as $category) {
            $categoryQuestions = Question::where('category_id', $category->id)
                ->where('is_active', true)
                ->orderBy('order')
                ->take($mode)
                ->get();

            $questions = $questions->concat($categoryQuestions);
        }

        return $questions;
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

        return view('test.question', compact('question', 'category', 'number', 'total', 'existingAnswer'));
    }

    public function answer(Request $request, $number)
    {
        $testId = session('test_id');
        $questionIds = session('test_questions');

        if (!$testId || !$questionIds) {
            return redirect()->route('test.index');
        }

        $request->validate([
            'answer' => 'required|integer|min:1|max:5',
        ]);

        $index = $number - 1;
        $questionId = $questionIds[$index];

        TestAnswer::updateOrCreate(
            ['test_result_id' => $testId, 'question_id' => $questionId],
            ['answer' => $request->answer, 'importance' => 3]
        );

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
        $answers = $testResult->answers()->with('question')->get();

        if ($answers->isEmpty()) {
            return redirect()->route('test.index');
        }

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
                    $weight = $position->weight;
                    $totalScore += (4 - $diff) * $weight;
                    $maxScore += 4 * $weight;
                }
            }

            $results[$party->id] = $maxScore > 0 ? round(($totalScore / $maxScore) * 100, 1) : 0;
        }

        arsort($results);

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
        session()->forget(['test_id', 'test_mode', 'test_questions']);
        return redirect()->route('test.index');
    }
}
