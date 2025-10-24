<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        // Tentukan path ke halaman login dari panel 'intern'.
        $loginUrl = Filament::getPanel('intern')->getLoginUrl();

        // Redirect ke halaman login panel 'intern'
        return redirect()->to($loginUrl);
    }
}
