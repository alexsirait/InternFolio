<?php

namespace App\Filament\Intern\Resources\Suggestions;

use BackedEnum;
use App\Models\Suggestion;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Intern\Resources\Suggestions\Pages\EditSuggestion;
use App\Filament\Intern\Resources\Suggestions\Pages\ViewSuggestion;
use App\Filament\Intern\Resources\Suggestions\Pages\ListSuggestions;
use App\Filament\Intern\Resources\Suggestions\Pages\CreateSuggestion;
use App\Filament\Intern\Resources\Suggestions\Schemas\SuggestionForm;
use App\Filament\Intern\Resources\Suggestions\Tables\SuggestionsTable;
use App\Filament\Intern\Resources\Suggestions\Schemas\SuggestionInfolist;
use App\Filament\Intern\Resources\Suggestions\Widgets\SuggestionStats;

class SuggestionResource extends Resource
{
    protected static ?string $model = Suggestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::LightBulb;

    protected static ?string $modelLabel = 'Saran';

    public static function form(Schema $schema): Schema
    {
        return SuggestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SuggestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuggestionsTable::configure($table);
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
            'index' => ListSuggestions::route('/'),
            'create' => CreateSuggestion::route('/create'),
            'view' => ViewSuggestion::route('/{record}'),
            'edit' => EditSuggestion::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $userId = Auth::id();

        return parent::getEloquentQuery()->where('user_id', $userId);
    }

    public static function getWidgets(): array
    {
        return [
            SuggestionStats::class,
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
}
