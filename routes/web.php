<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    $num_questions_asked = Question::count();
    $num_answers_given = Answer::count();
    $num_votes_cast = Vote::count();

    return view('index', compact('num_questions_asked', 'num_answers_given', 'num_votes_cast'));
})->name('home');

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Register
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

Route::middleware('auth')->group(function () {
    Route::resource('questions', QuestionController::class)->only(['store', 'update', 'destroy']);
    Route::resource('answers', AnswerController::class)->only(['create', 'store', 'update', 'destroy']);
    Route::post('/votes', VoteController::class)->name('votes.store');
});

// Locality
Route::get('/{state}/{locality}', [LocalityController::class, 'show'])
    ->name('locality')
    ->where(['state' => '[a-zA-Z-]+', 'locality' => '[a-zA-Z-]+']);
