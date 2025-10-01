<?php

namespace App\Filament\Intern\Resources\Ratings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RatingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('rating_uuid'),
                TextEntry::make('user.user_id')
                    ->label('User'),
                TextEntry::make('rating_range')
                    ->numeric(),
                TextEntry::make('rating_description')
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
