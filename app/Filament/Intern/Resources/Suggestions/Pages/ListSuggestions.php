<?php

namespace App\Filament\Intern\Resources\Suggestions\Pages;

use App\Filament\Intern\Resources\Suggestions\SuggestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuggestions extends ListRecords
{
    protected static string $resource = SuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
