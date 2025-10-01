<?php

namespace App\Filament\Intern\Resources\Ratings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RatingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('rating_uuid')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->required(),
                TextInput::make('rating_range')
                    ->required()
                    ->numeric(),
                Textarea::make('rating_description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
