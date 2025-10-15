<?php

namespace App\Filament\Intern\Resources\Projects\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->required()
                    ->options(Category::query()->where('category_type', 'Project')->pluck('category_name', 'category_id'))
                    ->native(false)
                    ->searchable(),
                TextInput::make('project_title')
                    ->label('Judul Project')
                    ->required(),
                Textarea::make('project_description')
                    ->label('Deskripsi Project')
                    ->required()
                    ->columnSpanFull()
                    ->autosize(),
                TagsInput::make('project_technology')
                    ->label('Teknologi yang digunakan')
                    ->required()
                    ->trim()
                    ->color('warning')
                    ->separator(',')
                    ->reorderable()
                    ->suggestions([
                        'TailwindCSS',
                        'PHP',
                        'Laravel',
                        'Livewire',
                        'Javascript',
                        'Python',
                        'Ruby',
                        'Elixir',
                    ]),
                TextInput::make('project_duration')
                    ->label('Lama Pengerjaan')
                    ->required()
                    ->suffix('Bulan')
                    ->minValue(0)
                    ->maxValue(60)
                    ->integer(),
            ]);
    }
}
