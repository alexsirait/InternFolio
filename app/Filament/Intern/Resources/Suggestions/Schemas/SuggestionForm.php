<?php

namespace App\Filament\Intern\Resources\Suggestions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('suggestion_uuid')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'category_id'),
                TextInput::make('suggestion_title')
                    ->required(),
                Textarea::make('suggestion_description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
