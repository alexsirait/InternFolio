<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;

class RedirectIfNotAuthenticated extends Authenticate
{
    protected function redirectTo($request): ?string
    {
        $panel = Filament::getCurrentPanel();

        // Jika panel yang sedang diakses adalah 'admin' dan user belum login
        if ($panel && $panel->getId() === 'admin') {
            return Filament::getPanel('intern')->getLoginUrl();
        }

        // Default: arahkan ke halaman login panel saat ini
        return $panel?->getLoginUrl();
    }
}
