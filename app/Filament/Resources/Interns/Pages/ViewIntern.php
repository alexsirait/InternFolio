<?php

namespace App\Filament\Resources\Interns\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Interns\InternResource;

class ViewIntern extends ViewRecord
{
    protected static string $resource = InternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reset_password')
                ->label('Reset Password')
                ->color(Color::Sky)
                ->icon('heroicon-o-key')
                ->requiresConfirmation()
                ->modalHeading('Reset Password Intern')
                ->modalDescription('Password akan direset menjadi password default.')
                ->modalSubmitActionLabel('Ya, Reset')
                ->action(function () {
                    $intern = $this->record;

                    // Reset password ke default
                    $intern->update([
                        'password' => Hash::make('Password321'),
                    ]);

                    Notification::make()
                        ->title('Password berhasil direset')
                        ->success()
                        ->body('Password baru: Password321')
                        ->send();
                }),
            EditAction::make(),
        ];
    }
}
