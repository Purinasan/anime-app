<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimeController;
use App\Http\Controllers\Api\EpisodeController;

// Anime Routes
Route::get('/anime', [AnimeController::class, 'index']);
Route::get('/anime/{id}', [AnimeController::class, 'show']);
Route::post('/anime', [AnimeController::class, 'store']);
Route::put('/anime/{id}', [AnimeController::class, 'update']);
Route::post('/anime/{id}', [AnimeController::class, 'update']); // For FormData
Route::delete('/anime/{id}', [AnimeController::class, 'destroy']);
Route::post('/anime-search', [AnimeController::class, 'search']);

// Episode Routes
Route::get('/anime/{animeId}/episodes', [EpisodeController::class, 'index']);
Route::get('/anime/{animeId}/episodes/{episodeId}', [EpisodeController::class, 'show']);
Route::get('/anime/{animeId}/episodes/{episodeId}/resolutions', [EpisodeController::class, 'resolutions']);