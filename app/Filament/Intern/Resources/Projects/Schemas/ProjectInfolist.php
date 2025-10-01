<?php

namespace App\Filament\Intern\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('project_uuid'),
                TextEntry::make('user.user_id')
                    ->label('User'),
                TextEntry::make('category.category_id')
                    ->label('Category')
                    ->placeholder('-'),
                TextEntry::make('project_title'),
                TextEntry::make('project_description')
                    ->columnSpanFull(),
                TextEntry::make('project_technology')
                    ->columnSpanFull(),
                TextEntry::make('project_duration')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
