<?php

namespace App\Filament\Resources\Interns\Tables;

use App\Models\Department;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class InternsTable
{
    public static function configure(Table $table): Table
    {
        $department = Department::get(['department_id', 'department_name', 'department_code']);

        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('user_name')
                    ->label('Nama Alumni')
                    ->sortable()
                    ->searchable(['user_name', 'user_badge'])
                    ->formatStateUsing(function ($record) {
                        $badge = $record->user_badge;
                        $name = $record->user_name;

                        return "{$name} ({$badge})";
                    }),
                TextColumn::make('department_id')
                    ->label('Nama Departemen')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        // Secara manual melakukan whereHas pada relasi 'department'
                        return $query->whereHas('department', function (Builder $query) use ($search) {
                            $query->where('department_name', 'like', "%{$search}%")
                                ->orWhere('department_code', 'like', "%{$search}%");
                        });
                    })
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
                    ->circular()
                    ->disk('public'),
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
            ])->defaultSort('updated_at', direction: 'desc')
            ->filters([
                TrashedFilter::make(),
                Filter::make('department_id')
                    ->schema([
                        Select::make('department_id')
                            ->label('Departemen')
                            ->options(
                                $department->mapWithKeys(function ($department) {
                                    return [
                                        $department->department_id => $department->department_name . ' - ' . $department->department_code,
                                    ];
                                })
                            )
                            ->searchable()
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['department_id'],
                                fn(Builder $query, $data): Builder => $query->where('department_id', $data),
                            );
                    }),
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
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->paginated([10, 25, 50, 100, 'all']);
    }
}
