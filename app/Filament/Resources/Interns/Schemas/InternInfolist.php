<?php

namespace App\Filament\Resources\Interns\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class InternInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('department_code')
                    ->label('Kode Department'),
            ]);
    }
}
