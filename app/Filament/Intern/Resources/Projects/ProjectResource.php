<?php

namespace App\Filament\Intern\Resources\Projects;

use BackedEnum;
use App\Models\Project;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Intern\Resources\Projects\Pages\EditProject;
use App\Filament\Intern\Resources\Projects\Pages\ViewProject;
use App\Filament\Intern\Resources\Projects\Pages\ListProjects;
use App\Filament\Intern\Resources\Projects\Pages\CreateProject;
use App\Filament\Intern\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Intern\Resources\Projects\Tables\ProjectsTable;
use App\Filament\Intern\Resources\Projects\Schemas\ProjectInfolist;
use App\Filament\Intern\Resources\Projects\Widgets\ProjectStats;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CpuChip;

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
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
            ProjectStats::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $userId = Auth::id();

        return static::getModel()::where('user_id', $userId)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
