<?php

namespace App\Filament\Intern\Resources\Suggestions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SuggestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('suggestion_uuid'),
                TextEntry::make('user.user_id')
                    ->label('User'),
                TextEntry::make('category.category_id')
                    ->label('Category')
                    ->placeholder('-'),
                TextEntry::make('suggestion_title'),
                TextEntry::make('suggestion_description')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
