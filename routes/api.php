<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimeController;

// Remove the Route::prefix('api') wrapper!
Route::get('/anime', [AnimeController::class, 'index']);
Route::get('/anime/{id}', [AnimeController::class, 'show']);
Route::post('/anime', [AnimeController::class, 'store']);
Route::put('/anime/{id}', [AnimeController::class, 'update']);
Route::post('/anime/{id}', [AnimeController::class, 'update']); // For FormData
Route::delete('/anime/{id}', [AnimeController::class, 'destroy']);
Route::post('/anime-search', [AnimeController::class, 'search']);