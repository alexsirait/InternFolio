<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
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
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category_type')
                    ->label('Tipe')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Project' => 'success',
                        'Suggestion' => 'info',
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
                            ->label('Kategori')
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
                    ->color(Color::Yellow),
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
