<?php

namespace App\Filament\Intern\Resources\Ratings\Pages;

use App\Filament\Intern\Resources\Ratings\RatingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRating extends ViewRecord
{
    protected static string $resource = RatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
