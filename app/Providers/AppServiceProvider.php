<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(LoginResponse::class, CustomLoginResponse::class);

        Response::macro('success', function ($data = null, $message = 'Success', $code = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $code);
        });

        Response::macro('error', function ($message = 'Error', $code = 400, $errors = null) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors,
            ], $code);
        });
    }
}
