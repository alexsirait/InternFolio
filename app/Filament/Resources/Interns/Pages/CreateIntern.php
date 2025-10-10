<?php

namespace App\Filament\Resources\Interns\Pages;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Interns\InternResource;

class CreateIntern extends CreateRecord
{
    protected static string $resource = InternResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate Bagde
        $userCount = User::where('is_admin', 0)->count();
        $nextNumber = $userCount + 1;
        $paddingLength = 3;
        $paddedNumber = Str::padLeft($nextNumber, $paddingLength, '0');
        $userBadge = 'PKL' . $paddedNumber;
        $data['user_badge'] = $userBadge;

        // Generate Email
        $userName = $data['user_name'];
        $nameParts = array_filter(explode(' ', $userName));

        if (count($nameParts) < 2) {
            $emailLocalPart = strtolower($userName);
        } else {
            $emailLocalPart = str_replace(' ', '.', strtolower($userName));
        }

        $email = $emailLocalPart . '@gmail.com';

        // Pengecekan Duplikat Email
        if (User::where('email', $email)->exists()) {
            $i = 1;
            $uniqueEmail = $email;

            while (User::where('email', $uniqueEmail)->exists()) {
                $uniqueEmail = $emailLocalPart . $i . '@gmail.com';
                $i++;
            }
            $email = $uniqueEmail;
        }

        $data['email'] = $email;

        // Generate Password
        $hashedPassword = Hash::make("Password321");
        $data['password'] = $hashedPassword;

        return $data;
    }
}
