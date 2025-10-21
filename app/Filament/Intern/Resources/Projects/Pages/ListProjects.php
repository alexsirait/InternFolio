<?php

namespace App\Filament\Intern\Resources\Projects\Pages;

use App\Filament\Intern\Resources\Projects\ProjectResource;
use App\Filament\Intern\Resources\Projects\Widgets\ProjectStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjectStats::class,
        ];
    }
}
