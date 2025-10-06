<?php

namespace App\Filament\Resources\Interns\Schemas;

use App\Models\Department;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class InternForm
{
    public static function configure(Schema $schema): Schema
    {
        $department = Department::get(['department_id', 'department_name', 'department_code']);

        return $schema
            ->components([
                Select::make('department_id')
                    ->label('Department')
                    ->options(
                        $department->mapWithKeys(function ($department) {
                            return [
                                $department->department_id => $department->department_name . ' - ' . $department->department_code,
                            ];
                        })
                    )
                    ->required()
                    ->searchable(['department_name', 'department_code'])
                    ->loadingMessage('Loading departments...')
                    ->noSearchResultsMessage('Tidak ada department yang sesuai!')
                    ->searchPrompt('Cari berdasarkan kode atau nama'),
                FileUpload::make('user_image')
                    ->image(),
                TextInput::make('user_name')
                    ->label('Nama Intern')
                    ->required(),
                TextInput::make('school')
                    ->label('Sekolah/Universitas')
                    ->required(),
                DatePicker::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->required()
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->suffixIcon(Heroicon::CalendarDateRange),
                DatePicker::make('end_date')
                    ->label('Tanggal Akhir')
                    ->required()
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->suffixIcon(Heroicon::CalendarDateRange),
            ]);
    }
}
