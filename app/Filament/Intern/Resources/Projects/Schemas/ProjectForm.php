<?php

namespace App\Filament\Intern\Resources\Projects\Schemas;

use App\Models\Category;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

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
                FileUpload::make('photos')
                    ->label('Foto Project')
                    ->helperText('Anda bisa upload lebih dari 1 gambar')
                    ->required()
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->maxSize(3072) // 3 MB
                    ->multiple()
                    ->columnSpanFull()
                    ->reorderable()
                    ->afterStateHydrated(function (FileUpload $component, $record) {
                        if ($record?->exists) {
                            $paths = $record->photos->pluck('photo_url')->toArray();
                            $component->state($paths);
                        }
                    })
                    ->dehydrated(false)
                    ->directory('project')
                    ->visibility('public')
                    ->disk('public')
                    ->saveRelationshipsUsing(function (FileUpload $component, $state, $record) {
                        $record->photos()->delete();

                        foreach ($state as $filePath) {
                            $record->photos()->create([
                                'photo_url' => $filePath,
                            ]);
                        }
                    }),
            ]);
    }
}
