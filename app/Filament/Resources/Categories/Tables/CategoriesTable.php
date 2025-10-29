<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Illuminate\Database\Eloquent\Builder;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('category_name')
                    ->label('Nama Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category_type')
                    ->label('Tipe Kategori')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Project' => 'success',
                        'Suggestion' => 'info',
                    }),
                ColorColumn::make('bg_color')
                    ->label('Warna Latar Belakang')
                    ->copyable()
                    ->copyMessage('Berhasil copy!')
                    ->copyMessageDuration(1000)
                    ->getStateUsing(function ($record) {
                        $state = $record->bg_color; // Ambil nilai mentah dari database

                        if (is_string($state) && str_starts_with($state, '0x')) {
                            // Konversi dari 0xAARRGGBB ke #RRGGBB
                            $rgb = substr($state, 4);
                            return '#' . $rgb;
                        }

                        return $state;
                    }),
                ColorColumn::make('txt_color')
                    ->label('Warna Teks')
                    ->copyable()
                    ->copyMessage('Berhasil copy!')
                    ->copyMessageDuration(1000)
                    ->getStateUsing(function ($record) {
                        $state = $record->txt_color; // Ambil nilai mentah dari database

                        if (is_string($state) && str_starts_with($state, '0x')) {
                            // Konversi dari 0xAARRGGBB ke #RRGGBB
                            $rgb = substr($state, 4);
                            return '#' . $rgb;
                        }

                        return $state;
                    }),
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
                Filter::make('category_type')
                    ->schema([
                        Select::make('category_type')
                            ->label('Tipe Kategori')
                            ->options([
                                'Project' => 'Project',
                                'Suggestion' => 'Suggestion'
                            ])
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['category_type'],
                                fn(Builder $query, $data): Builder => $query->where('category_type', $data),
                            );
                    }),
            ])
            ->recordActions([
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
