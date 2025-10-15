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
                TextEntry::make('category.category_name')
                    ->label('Kategori')
                    ->placeholder('-'),
                TextEntry::make('project_title')
                    ->label('Judul Project'),
                TextEntry::make('project_description')
                    ->label('Deskripsi Project')
                    ->columnSpanFull(),
                TextEntry::make('project_technology')
                    ->badge()
                    ->color('warning')
                    ->separator(','),
                TextEntry::make('project_duration')
                    ->label('Durasi')
                    ->suffix(' Bulan')
                    ->numeric(),
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
