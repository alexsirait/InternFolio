<?php

namespace App\Filament\Intern\Resources\Suggestions\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class SuggestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.category_name')
                    ->label('Kategori')
                    ->placeholder('-'),
                TextEntry::make('suggestion_title')
                    ->label('Judul'),
                TextEntry::make('suggestion_description')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->markdown(),
                TextEntry::make('created_at')
                    ->label('Dibuat pada')
                    ->isoDateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diubah pada')
                    ->isoDateTime()
                    ->placeholder('-'),
            ]);
    }
}
