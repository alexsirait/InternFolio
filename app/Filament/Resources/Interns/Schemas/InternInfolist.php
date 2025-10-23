<?php

namespace App\Filament\Resources\Interns\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class InternInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_name')
                    ->label('Nama Alumni Magang')
                    ->formatStateUsing(function ($state, $record): string {
                        $user_name = $record->user_name;
                        $user_badge = $record->user_badge;

                        return "{$user_name} ({$user_badge})";
                    }),
                TextEntry::make('department.department_code')
                    ->label('Departemen')
                    ->formatStateUsing(function ($state, $record): string {
                        $department = $record->department;

                        // Pastikan relasi department ada dan tidak null
                        if ($department) {
                            // Menggabungkan nama dan kode department
                            return "{$department->department_name} - {$department->department_code}";
                        }

                        return 'N/A';
                    }),
                TextEntry::make('email')
                    ->label('Email'),
                TextEntry::make('position')
                    ->label('Posisi')
                    ->placeholder('-'),
                TextEntry::make('join_date')
                    ->label('Tanggal Bergabung')
                    ->date('l, d F Y')
                    ->sinceTooltip()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->label('Tanggal Akhir')
                    ->date('l, d F Y')
                    ->sinceTooltip()
                    ->placeholder('-'),
                ImageEntry::make('user_image')
                    ->label('Foto Alumni Magang')
                    ->columnSpanFull()
                    ->imageSize(250)
                    ->circular()
                    ->disk('public'),
                TextEntry::make('school')
                    ->label('Asal Sekolah/Universitas')
                    ->placeholder('-'),
                TextEntry::make('major')
                    ->label('Jurusan')
                    ->placeholder('-'),
                TextEntry::make('linkedin_url')
                    ->label('Link LinkedIn')
                    ->placeholder('-')
                    ->icon(Heroicon::GlobeAlt)
                    ->iconColor('info')
                    ->copyable()
                    ->copyMessage('Berhasil copy!')
                    ->copyMessageDuration(1500),
                TextEntry::make('instagram_url')
                    ->label('Link Instagram')
                    ->placeholder('-')
                    ->icon(Heroicon::GlobeAlt)
                    ->iconColor('info')
                    ->copyable()
                    ->copyMessage('Berhasil copy!')
                    ->copyMessageDuration(1500),
                TextEntry::make('created_at')
                    ->label('Dibuat pada')
                    ->isoDateTime()
                    ->sinceTooltip()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diubah pada')
                    ->isoDateTime()
                    ->sinceTooltip()
                    ->placeholder('-'),
            ]);
    }
}
