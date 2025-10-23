<?php

namespace App\Filament\Resources\Interns\Schemas;

use App\Models\Department;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Storage;
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
                    ->label('Departemen')
                    ->options(
                        $department->mapWithKeys(function ($department) {
                            return [
                                $department->department_id => $department->department_name . ' - ' . $department->department_code,
                            ];
                        })
                    )
                    ->required()
                    ->searchable(['department_name', 'department_code'])
                    ->loadingMessage('Loading departemen...')
                    ->noSearchResultsMessage('Tidak ada departemen yang sesuai!')
                    ->searchPrompt('Cari berdasarkan kode atau nama departemen')
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
                FileUpload::make('user_image')
                    ->label('Foto Alumni Magang')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->maxSize(3072) // 3 MB
                    ->directory('interns')
                    ->disk('public')
                    ->visibility('public')
                    ->afterStateUpdated(function ($state, $component, $record) {
                        // Jika mengganti file saat edit, hapus file lama
                        if ($record && $record->getOriginal('user_image') && $record->getOriginal('user_image') !== $state) {
                            Storage::disk('public')->delete($record->getOriginal('user_image'));
                        }
                    }),
                TextInput::make('user_name')
                    ->label('Nama Alumni Magang')
                    ->required(),
                TextInput::make('school')
                    ->label('Sekolah/Universitas')
                    ->required(),
                DatePicker::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->required()
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->suffixIcon(Heroicon::CalendarDateRange)
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
                DatePicker::make('end_date')
                    ->label('Tanggal Akhir')
                    ->required()
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->suffixIcon(Heroicon::CalendarDateRange)
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
            ]);
    }
}
