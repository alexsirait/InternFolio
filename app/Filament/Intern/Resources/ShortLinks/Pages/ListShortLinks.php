<?php

namespace App\Filament\Intern\Resources\ShortLinks\Pages;

use App\Filament\Intern\Resources\ShortLinks\ShortLinkResource;
use App\Filament\Intern\Resources\ShortLinks\Widgets\ShortLinkStats;
use Filament\Resources\Pages\ListRecords;

class ListShortLinks extends ListRecords
{
    protected static string $resource = ShortLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada create action karena shortlink dibuat otomatis
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ShortLinkStats::class,
        ];
    }
}
