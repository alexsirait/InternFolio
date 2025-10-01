<?php

namespace App\Filament\Intern\Resources\Suggestions\Pages;

use App\Filament\Intern\Resources\Suggestions\SuggestionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSuggestion extends EditRecord
{
    protected static string $resource = SuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
