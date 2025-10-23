<?php

namespace App\Filament\Resources\Departments\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('department_code')
                    ->label('Kode Departemen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('department_name')
                    ->label('Nama Departemen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->isoDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diubah pada')
                    ->isoDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('updated_at', direction: 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->color('info'),
                EditAction::make()
                    ->color('warning'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->paginated([10, 25, 50, 100, 'all']);
    }
}
