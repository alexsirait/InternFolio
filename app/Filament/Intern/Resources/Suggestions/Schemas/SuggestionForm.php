<?php

namespace App\Filament\Intern\Resources\Suggestions\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class SuggestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->required()
                    ->options(Category::query()->where('category_type', 'Suggestion')->pluck('category_name', 'category_id'))
                    ->native(false)
                    ->searchable(),
                TextInput::make('suggestion_title')
                    ->label('Judul')
                    ->required(),
                Textarea::make('suggestion_description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull()
                    ->autosize(),
            ]);
    }
}
