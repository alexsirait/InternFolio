<?php

namespace App\Filament\Resources\Interns\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Support\Colors\Color;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class InternsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('user_name')
                    ->label('Nama Intern')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        $badge = $record->user_badge;
                        $name = $record->user_name;

                        return "{$name} ({$badge})";
                    }),
                TextColumn::make('department_id')
                    ->label('Nama Department')
                    ->searchable()
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->department) {
                            $code = $record->department->department_code;
                            $name = $record->department->department_name;

                            return "{$name} - {$code}";
                        }
                        return '-';
                    }),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                ImageColumn::make('user_image')
                    ->label('Foto')
                    ->imageSize(100)
                    ->circular(),
                TextColumn::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->date('l, d F Y'),
                TextColumn::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->date('l, d F Y'),
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
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->color(Color::Blue),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
