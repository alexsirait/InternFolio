<?php

namespace App\Filament\Resources\Interns\Pages;

use App\Filament\Resources\Interns\InternResource;
use App\Filament\Resources\Interns\Widgets\InternStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInterns extends ListRecords
{
    protected static string $resource = InternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            InternStats::class,
        ];
    }
}
