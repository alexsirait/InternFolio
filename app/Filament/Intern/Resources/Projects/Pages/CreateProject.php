<?php

namespace App\Filament\Intern\Resources\Projects\Pages;

use App\Filament\Intern\Resources\Projects\ProjectResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userId = Auth::id();
        $data['user_id'] = $userId;

        return $data;
    }
}
