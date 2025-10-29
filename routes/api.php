<?php

use App\Http\Controllers\Api\InternController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\json;

Route::prefix('v1')->group(function () {
    // Intern
    Route::prefix('intern')->group(function () {
        Route::get('/dashboard', [InternController::class, 'dashboard']);
        Route::get('/index', [InternController::class, 'index']);
        Route::get('/show/{user}', [InternController::class, 'show']);
    });
});
