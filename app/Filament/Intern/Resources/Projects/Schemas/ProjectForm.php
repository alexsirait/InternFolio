<?php

namespace App\Filament\Intern\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('project_uuid')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'user_id')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'category_id'),
                TextInput::make('project_title')
                    ->required(),
                Textarea::make('project_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('project_technology')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('project_duration')
                    ->required()
                    ->numeric(),
            ]);
    }
}
