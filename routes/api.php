<?php

use Illuminate\Http\Request;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\InternController;
use App\Http\Controllers\Api\ProjectController;

Route::prefix('v1')->group(function () {
    // Intern
    Route::prefix('intern')->group(function () {
        Route::get('/dashboard', [InternController::class, 'dashboard']);
        Route::get('/index', [InternController::class, 'index']);
        Route::get('/show/{user}', [InternController::class, 'show']);
    });

    // Project
    Route::prefix('project')->group(function () {
        Route::get('/dashboard', [ProjectController::class, 'dashboard']);
        Route::get('/index', [ProjectController::class, 'index']);
        Route::get('/show/{project}', [ProjectController::class, 'show']);
    });
});
