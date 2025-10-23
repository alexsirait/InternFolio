<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
    }
}
