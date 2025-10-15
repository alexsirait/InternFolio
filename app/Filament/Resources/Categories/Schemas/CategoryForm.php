<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_type')
                    ->options(['Project' => 'Project', 'Suggestion' => 'Suggestion'])
                    ->native(false)
                    ->required(),
                TextInput::make('category_name')
                    ->required(),
            ]);
    }
}
