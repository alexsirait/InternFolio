<?php

namespace App\Filament\Intern\Resources\Ratings\Pages;

use App\Filament\Intern\Resources\Ratings\RatingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRating extends CreateRecord
{
    protected static string $resource = RatingResource::class;
}
