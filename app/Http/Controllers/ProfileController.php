<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Get the authenticated user
        $user = Auth::user();

        //categories
        $categories = ['art', 'geography', 'history', 'science', 'sports'];

        $stats = [];

        foreach ($categories as $cat) {
            [$correct, $total] = explode('/', $user->$cat);
            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
            $stats[$cat] = [
                'correct' => (int)$correct,
                'total' => (int)$total,
                'percentage' => $percentage
            ];
        }

        $xp = $user->xp;

        if ($xp < 1500) {
            $rank = 'Quiz Apprentice';
        }elseif ($xp < 5000) {
            $rank = ' Average Quizzer';
        }elseif ($xp < 10000) {
            $rank = 'Epic Quizzer';
        }else {
            $rank = 'Quiz Master';
        }

        return view('profile', [
            'user' => $user,
            'stats' => $stats,
            'rank' => $rank
        ]);
    }
}
