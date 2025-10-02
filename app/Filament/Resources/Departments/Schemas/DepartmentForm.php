<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('department_code')
                    ->label('Kode Department')
                    ->required(),
                TextInput::make('department_name')
                    ->label('Nama Department')
                    ->required(),
            ]);
    }
}
