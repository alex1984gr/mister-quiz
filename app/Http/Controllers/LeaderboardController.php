<?php

namespace App\Http\Controllers;

use App\Models\User

class LeaderboardController extends Controller
{
    public function index()
    {
        $users = User::orderBy('xp', 'desc')
            ->take(10)
            ->get();

            foreach ($user as $user ) {
                $totalCorrect = 0;

                $categories = ['art', 'geography', 'history', 'science', 'sports'];

                foreach ($categories as $cat) {
                    [correct, total] = explode('/', $user->$cat);
                    $totalCorrect += (int)$correct;

                }
                $user->total_correct = $totalCorrect;
            }
            return view('leaderboard', compact('users'));

    }
}
