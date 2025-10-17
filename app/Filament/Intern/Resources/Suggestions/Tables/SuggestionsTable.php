<?php

namespace App\Filament\Intern\Resources\Suggestions\Tables;

use App\Models\Category;
use App\Models\Suggestion;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class SuggestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('suggestion_title')
                    ->label('Judul')
                    ->description(fn(Suggestion $record): string => $record->suggestion_description)
                    ->searchable(),
                TextColumn::make('category.category_name')
                    ->label('Kategori')
                    ->sortable()
                    ->badge()
                    ->color(
                        function (string $state): string {
                            $availableColors = [
                                'primary',
                                'success',
                                'warning',
                                'danger',
                                'info',
                                'gray',
                            ];

                            $hash = md5($state);

                            $numericHash = hexdec(substr($hash, 0, 8));

                            $index = $numericHash % count($availableColors);

                            return $availableColors[$index];
                        }
                    ),
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
                Filter::make('category_id')
                    ->schema([
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(Category::where('category_type', 'Suggestion')->pluck('category_name', 'category_id'))
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['category_id'],
                                fn(Builder $query, $data): Builder => $query->where('category_id', $data),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->color(Color::Blue),
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
