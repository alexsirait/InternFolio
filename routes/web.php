<?php

use App\Http\Controllers\InternController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('interns')->group(function () {
    Route::get('', [InternController::class, 'index'])->name('intern.index');
    Route::get('{user}', [InternController::class, 'show'])->name('intern.show');
});

Route::prefix('project')->group(function () {
    Route::get('', [ProjectController::class, 'index'])->name('project.index');
    Route::get('{project}', [ProjectController::class, 'show'])->name('project.show');
});

Route::prefix('suggestion')->group(function () {
    Route::get('', [SuggestionController::class, 'index'])->name('suggestion.index');
    Route::get('{suggestion}', [SuggestionController::class, 'show'])->name('suggestion.show');
});
