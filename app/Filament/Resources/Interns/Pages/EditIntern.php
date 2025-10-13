<?php

namespace App\Filament\Resources\Interns\Pages;

use App\Models\User;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Interns\InternResource;

class EditIntern extends EditRecord
{
    protected static string $resource = InternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
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

        return $data;
    }
}
