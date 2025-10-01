<?php

namespace App\Filament\Intern\Resources\Suggestions\Pages;

use App\Filament\Intern\Resources\Suggestions\SuggestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSuggestion extends CreateRecord
{
    protected static string $resource = SuggestionResource::class;
}
