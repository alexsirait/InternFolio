<?php

use Illuminate\Http\Request;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\InternController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SuggestionController;

Route::prefix('v1')->group(function () {
    // Master
    Route::prefix('master')->group(function () {
        Route::get('/list_master_department', [MasterController::class, 'list_master_department']);
        Route::get('/list_master_category', [MasterController::class, 'list_master_category']);
    });

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

    // suggestion
    Route::prefix('suggestion')->group(function () {
        Route::get('/dashboard', [SuggestionController::class, 'dashboard']);
        Route::get('/index', [SuggestionController::class, 'index']);
        Route::get('/show/{suggestion}', [SuggestionController::class, 'show']);
    });
});
