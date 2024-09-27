<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IrisController;

Route::get('/train', [IrisController::class, 'train']);
Route::post('/predict', [IrisController::class, 'predict']);
Route::view('/', 'iris');
