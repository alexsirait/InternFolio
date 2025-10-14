<?php

namespace App\Filament\Resources\Interns;

use App\Filament\Resources\Interns\Pages\CreateIntern;
use App\Filament\Resources\Interns\Pages\EditIntern;
use App\Filament\Resources\Interns\Pages\ListInterns;
use App\Filament\Resources\Interns\Pages\ViewIntern;
use App\Filament\Resources\Interns\Schemas\InternForm;
use App\Filament\Resources\Interns\Schemas\InternInfolist;
use App\Filament\Resources\Interns\Tables\InternsTable;
use App\Filament\Resources\Interns\Widgets\InternStats;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InternResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;

    protected static ?string $modelLabel = 'Intern';

    public static function form(Schema $schema): Schema
    {
        return InternForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InternInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InternsTable::configure($table);
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
            'index' => ListInterns::route('/'),
            'create' => CreateIntern::route('/create'),
            'view' => ViewIntern::route('/{record}'),
            'edit' => EditIntern::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_admin', 0)->with(['department']);
    }

    public static function getWidgets(): array
    {
        return [
            InternStats::class,
        ];
    }
}
