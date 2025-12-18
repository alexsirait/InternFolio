<?php

namespace App\Filament\Intern\Resources\ShortLinks;

use BackedEnum;
use App\Models\ShortLink;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Intern\Resources\ShortLinks\Pages\ListShortLinks;
use App\Filament\Intern\Resources\ShortLinks\Tables\ShortLinksTable;
use App\Filament\Intern\Resources\ShortLinks\Widgets\ShortLinkStats;
use Illuminate\Support\Facades\Auth;

class ShortLinkResource extends Resource
{
    protected static ?string $model = ShortLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Link;

    protected static ?string $modelLabel = 'Short Link';

    protected static ?string $pluralModelLabel = 'Short Links';

    protected static ?string $navigationLabel = 'Short Links';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return ShortLinksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShortLinks::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $userId = Auth::id();

        // Hanya tampilkan shortlink milik user yang sedang login
        // Eager load relasi linkable agar data muncul di table
        return parent::getEloquentQuery()
            ->where('user_id', $userId)
            ->with('linkable');
    }

    public static function getWidgets(): array
    {
        return [
            ShortLinkStats::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $userId = Auth::id();

        return static::getModel()::where('user_id', $userId)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function canCreate(): bool
    {
        // Disable create karena shortlink dibuat otomatis
        return false;
    }

    public static function canEdit($record): bool
    {
        // Disable edit karena shortlink tidak perlu diedit
        return false;
    }

    public static function canDelete($record): bool
    {
        // Disable delete untuk keamanan data
        return false;
    }
}
