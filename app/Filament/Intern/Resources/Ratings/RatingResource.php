<?php

namespace App\Filament\Intern\Resources\Ratings;

use App\Filament\Intern\Resources\Ratings\Pages\CreateRating;
use App\Filament\Intern\Resources\Ratings\Pages\EditRating;
use App\Filament\Intern\Resources\Ratings\Pages\ListRatings;
use App\Filament\Intern\Resources\Ratings\Pages\ViewRating;
use App\Filament\Intern\Resources\Ratings\Schemas\RatingForm;
use App\Filament\Intern\Resources\Ratings\Schemas\RatingInfolist;
use App\Filament\Intern\Resources\Ratings\Tables\RatingsTable;
use App\Models\Rating;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RatingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RatingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RatingsTable::configure($table);
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
            'index' => ListRatings::route('/'),
            'create' => CreateRating::route('/create'),
            'view' => ViewRating::route('/{record}'),
            'edit' => EditRating::route('/{record}/edit'),
        ];
    }
}
