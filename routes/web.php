<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AnimeController;
use App\Http\Controllers\Admin\EpisodeController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Anime Routes
    Route::get('/anime', [AnimeController::class, 'index'])->name('anime.index');
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
    Route::get('/anime/{id}/edit', [AnimeController::class, 'edit'])->name('anime.edit');
    Route::put('/anime/{id}', [AnimeController::class, 'update'])->name('anime.update');
    Route::delete('/anime/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');
    
    // Episode Routes
    Route::get('/anime/{animeId}/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
    Route::get('/anime/{animeId}/episodes/create', [EpisodeController::class, 'create'])->name('episodes.create');
    Route::post('/anime/{animeId}/episodes', [EpisodeController::class, 'store'])->name('episodes.store');
    Route::get('/anime/{animeId}/episodes/{episodeId}/edit', [EpisodeController::class, 'edit'])->name('episodes.edit');
    Route::put('/anime/{animeId}/episodes/{episodeId}', [EpisodeController::class, 'update'])->name('episodes.update');
    Route::delete('/anime/{animeId}/episodes/{episodeId}', [EpisodeController::class, 'destroy'])->name('episodes.destroy');
});