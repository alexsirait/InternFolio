<?php

namespace App\Filament\Intern\Resources\Suggestions\Pages;

use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Intern\Resources\Suggestions\SuggestionResource;

class CreateSuggestion extends CreateRecord
{
    protected static string $resource = SuggestionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userId = Auth::id();
        $data['user_id'] = $userId;

        return $data;
    }
}
