<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/search', SearchController::class)->name('search');

Route::get('/{state}/{locality}', [LocalityController::class, 'show'])
    ->name('locality')
    ->where(['state' => '[a-zA-Z]+', 'locality' => '[a-zA-Z]+']);

Route::middleware('auth')->group(function () {
    Route::resource('questions', QuestionController::class)->only(['store', 'update', 'destroy']);
    Route::resource('answers', AnswerController::class)->only(['store', 'update', 'destroy']);
    Route::resource('votes', VoteController::class)->only(['store', 'update', 'destroy']);
});
