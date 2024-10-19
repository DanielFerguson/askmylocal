<?php

use App\Http\Controllers\LocalityController;
use Illuminate\Support\Facades\Route;

Route::get('/localities', [LocalityController::class, 'index']);
