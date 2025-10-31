<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_type')
                    ->label('Tipe Kategori')
                    ->options(['Project' => 'Project', 'Suggestion' => 'Suggestion'])
                    ->native(false)
                    ->required()
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
                TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required()
                    ->minLength(2)
                    ->validationMessages([
                        'required' => ':attribute wajib diisi!',
                    ]),
                ColorPicker::make('bg_color')
                    ->label('Warna Latar Belakang')
                    ->default('#FFFFFF')
                    ->required()
                    ->mutateDehydratedStateUsing(function ($state) {
                        if (! $state) {
                            return null;
                        }
                        // Hapus '#' di awal dan tambahkan '0xFF' (Alpha) + '0x' di depan
                        $hex_rgb = ltrim($state, '#');
                        return '0xFF' . strtoupper($hex_rgb);
                    })
                    ->afterStateHydrated(function (ColorPicker $component, $state) {
                        // Cek apakah data dari database memiliki format '0x...'
                        if (is_string($state) && str_starts_with($state, '0x')) {
                            // 1. Ambil 6 digit RRGGBB (setelah '0x' dan 'AA' Alpha)
                            $rgb = substr($state, 4); // Contoh: dari '0xFFAAAAAA' menjadi 'AAAAAA'

                            // 2. Set state komponen ke format HEX CSS
                            $component->state('#' . $rgb); // Hasil: '#AAAAAA'
                        }
                    }),
                ColorPicker::make('txt_color')
                    ->label('Warna Teks')
                    ->default('#FFFFFF')
                    ->required()
                    ->mutateDehydratedStateUsing(function ($state) {
                        if (! $state) {
                            return null;
                        }
                        // Hapus '#' di awal dan tambahkan '0xFF' (Alpha) + '0x' di depan
                        $hex_rgb = ltrim($state, '#');
                        return '0xFF' . strtoupper($hex_rgb);
                    })
                    ->afterStateHydrated(function (ColorPicker $component, $state) {
                        // Cek apakah data dari database memiliki format '0x...'
                        if (is_string($state) && str_starts_with($state, '0x')) {
                            // 1. Ambil 6 digit RRGGBB (setelah '0x' dan 'AA' Alpha)
                            $rgb = substr($state, 4); // Contoh: dari '0xFFAAAAAA' menjadi 'AAAAAA'

                            // 2. Set state komponen ke format HEX CSS
                            $component->state('#' . $rgb); // Hasil: '#AAAAAA'
                        }
                    }),
            ]);
    }
}
