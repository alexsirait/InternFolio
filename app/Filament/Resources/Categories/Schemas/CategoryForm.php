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
                    ->label('Tipe Kategori')
                    ->options(['Project' => 'Project', 'Suggestion' => 'Suggestion'])
                    ->native(false)
                    ->required()
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
                TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required()
                    ->minLength(2)
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
            ]);
    }
}
