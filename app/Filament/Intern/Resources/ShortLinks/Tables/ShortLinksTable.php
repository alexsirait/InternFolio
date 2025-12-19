<?php

namespace App\Filament\Intern\Resources\ShortLinks\Tables;

use App\Models\ShortLink;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class ShortLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                TextColumn::make('code')
                    ->label('Kode Short Link')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Kode berhasil disalin!')
                    ->description(fn(ShortLink $record): string => $record->short_url)
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('linkable_type')
                    ->label('Tipe Konten')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => class_basename($state))
                    ->color(fn(string $state): string => match (class_basename($state)) {
                        'User' => 'info',
                        'Project' => 'warning',
                        'Suggestion' => 'success',
                        default => 'gray',
                    })
                    ->icon(fn(string $state): string => match (class_basename($state)) {
                        'User' => 'heroicon-o-user',
                        'Project' => 'heroicon-o-briefcase',
                        'Suggestion' => 'heroicon-o-light-bulb',
                        default => 'heroicon-o-link',
                    }),
                TextColumn::make('linkable.title')
                    ->label('Judul Konten')
                    ->getStateUsing(function (ShortLink $record) {
                        // Gunakan method helper untuk load by UUID
                        $linkable = $record->loadLinkableByUuid();
                        
                        if (!$linkable) {
                            return 'Konten tidak ditemukan';
                        }

                        $type = class_basename($record->linkable_type);
                        
                        return match ($type) {
                            'User' => $linkable->user_name ?? 'N/A',
                            'Project' => $linkable->project_title ?? 'N/A',
                            'Suggestion' => $linkable->suggestion_title ?? 'N/A',
                            default => 'Unknown Type',
                        };
                    })
                    ->limit(40)
                    ->searchable(query: function ($query, $search) {
                        return $query->where(function ($q) use ($search) {
                            $q->whereHasMorph('linkable', ['App\Models\User'], function ($query) use ($search) {
                                $query->where('user_name', 'like', "%{$search}%");
                            })
                                ->orWhereHasMorph('linkable', ['App\Models\Project'], function ($query) use ($search) {
                                    $query->where('project_title', 'like', "%{$search}%");
                                })
                                ->orWhereHasMorph('linkable', ['App\Models\Suggestion'], function ($query) use ($search) {
                                    $query->where('suggestion_title', 'like', "%{$search}%");
                                });
                        });
                    }),
                TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime('d M Y H:i')
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir diklik')
                    ->dateTime('d M Y H:i')
                    ->toggleable(),
                TextColumn::make('clicks')
                        ->label('Total Klik')
                        ->numeric()
                        ->sortable()
                        ->badge()
                        ->color(fn(int $state): string => match (true) {
                            $state >= 100 => 'success',
                            $state >= 50 => 'warning',
                            $state >= 10 => 'info',
                            default => 'primary',
                        })
                        ->icon('heroicon-o-cursor-arrow-ripple'),
            ])
            ->defaultSort('clicks', direction: 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('linkable_type')
                    ->label('Tipe Konten')
                    ->options([
                        'App\Models\User' => 'Profil Alumni',
                        'App\Models\Project' => 'Project',
                        'App\Models\Suggestion' => 'Tips & Saran',
                    ])
                    ->placeholder('Semua Tipe'),
            ])
            ->emptyStateHeading('Belum ada Short Link')
            ->emptyStateDescription('Short link akan dibuat otomatis ketika konten Anda dibagikan.')
            ->emptyStateIcon('heroicon-o-link')
            ->paginated([10, 25, 50, 100]);
    }
}
