<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AnimeController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/anime', [AnimeController::class, 'index'])->name('anime.index');
    Route::get('/anime/create', [AnimeController::class, 'create'])->name('anime.create');
    Route::post('/anime', [AnimeController::class, 'store'])->name('anime.store');
    Route::get('/anime/{id}/edit', [AnimeController::class, 'edit'])->name('anime.edit');
    Route::put('/anime/{id}', [AnimeController::class, 'update'])->name('anime.update');
    Route::delete('/anime/{id}', [AnimeController::class, 'destroy'])->name('anime.destroy');
});