<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->session()->has('quiz_questions')) {
            $questions = $request->session()->get('quiz_questions');
        } else {

            $categories = ['History', 'Art', 'Geography', 'Science', 'Sports'];
            $questions = [];

            foreach ($categories as $cat) {
                $query = Question::where('category', $cat)
                    ->inRandomOrder()
                    ->limit(4)
                    ->get();

                foreach ($query as $q) {
                    $questions[] = $q;
                }
            }

            shuffle($questions);

            $request->session()->put('quiz_questions', $questions);
        }

        return view('questions.list', compact('questions'));
    }


    public function results(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $answers = $request->all();

        if (!$request->session()->has('quiz_questions')) {
            return redirect()->route('quiz');
        }

        $questions = $request->session()->get('quiz_questions');

        foreach ($questions as $q) {
            if (!isset($answers[$q->id])) {
                return back()->withErrors(['error' => 'Answer all questions']);
            }
        }

        $results = [
            'overall' => 0,
            'art' => 0,
            'geography' => 0,
            'history' => 0,
            'science' => 0,
            'sports' => 0
        ];

        $xp = 0;

        foreach ($questions as $q) {
            $userAnswer = $answers[$q->id];

            $correct = Answer::where('question_id', $q->id)
                ->where('correct', 1)
                ->first();

            if ($correct && $correct->answer == $userAnswer) {

                $results['overall']++;

                $category = strtolower($q->category);
                $results[$category]++;

                $xp += 10;
            }
        }

        $user = Auth::user();


        $user->xp += $xp;

        foreach ($results as $key => $value) {
            if ($key != 'overall') {
                [$correct, $total] = explode("/", $user->$key);
                $user->$key = ($correct + $value) . "/" . ($total + count($questions) / 5);
            }
        }

        $user->save();

        $request->session()->forget('quiz_questions');

        return view('questions.results', compact('results', 'xp'));
    }
}
