<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Identitas Pelanggan')
                    ->components([
                        \Filament\Schemas\Components\Grid::make(3)
                            ->components([
                                TextInput::make('name')
                                    ->label('Nama Pelanggan')
                                    ->required(),
                                TextInput::make('role')
                                    ->label('Keterangan/Jabatan (Contoh: Pelanggan Setia)'),
                                TextInput::make('rating')
                                    ->label('Rating (1-5)')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->default(5),
                            ]),
                    ]),
                \Filament\Schemas\Components\Section::make('Isi Testimoni')
                    ->components([
                        Textarea::make('content')
                            ->label('Pesan Testimoni')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        \Filament\Schemas\Components\Grid::make(2)
                            ->components([
                                FileUpload::make('image')
                                    ->label('Foto Hasil Pekerjaan / Pelanggan')
                                    ->image()
                                    ->directory('testimonials')
                                    ->visibility('public'),
                                Toggle::make('is_active')
                                    ->label('Tampilkan di Website')
                                    ->inline(false)
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
