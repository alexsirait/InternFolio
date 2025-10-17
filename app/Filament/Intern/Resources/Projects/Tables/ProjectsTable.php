<?php

namespace App\Filament\Intern\Resources\Projects\Tables;

use App\Models\Project;
use App\Models\Category;
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
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        $category = Category::where('category_type', 'Project')
            ->orderBy('category_name')
            ->pluck('category_name', 'category_id');

        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('project_title')
                    ->label('Judul')
                    ->description(fn(Project $record): string => $record->project_description)
                    ->searchable(),
                ImageColumn::make('photos.photo_url')
                    ->imageHeight(40)
                    ->disk('public')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
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
                            ->options($category)
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
