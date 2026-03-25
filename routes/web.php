<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Questions\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('home');
})->name('home');

// AUTH
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


// PROFILE (logged in users only)
Route::get('/profile', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profile');


// LEADERBOARD (public)
Route::get('/leaderboard', [LeaderboardController::class, 'index'])
    ->name('leaderboard');


// QUIZ (logged in users only)
Route::get('/quiz', [QuestionController::class, 'index'])
    ->middleware('auth')
    ->name('quiz');

Route::post('/quiz', [QuestionController::class, 'results'])
    ->middleware('auth')
    ->name('quiz.submit');
