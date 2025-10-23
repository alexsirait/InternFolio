<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // dd($user);

        if ($user->is_admin == 1) {
            return redirect()->to(Filament::getPanel('admin')->getUrl());
        }

        return redirect()->to(Filament::getPanel('intern')->getUrl());
    }
}
