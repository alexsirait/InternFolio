<?php

namespace App\Filament\Resources\Interns\Pages;

use App\Filament\Resources\Interns\InternResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIntern extends ViewRecord
{
    protected static string $resource = InternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
