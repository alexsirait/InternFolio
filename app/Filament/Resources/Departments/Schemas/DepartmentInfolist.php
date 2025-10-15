<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('department_code')
                    ->label('Kode Department'),
                TextEntry::make('department_name')
                    ->label('Nama Department'),
                TextEntry::make('created_at')
                    ->label('Dibuat pada')
                    ->isoDateTime()
                    ->sinceTooltip()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diubah pada')
                    ->isoDateTime()
                    ->sinceTooltip()
                    ->placeholder('-'),
            ]);
    }
}
