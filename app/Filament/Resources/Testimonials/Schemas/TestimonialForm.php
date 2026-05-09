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
                                    ->placeholder('Dhika Hafidz')
                                    ->required(),
                                TextInput::make('role')
                                    ->label('Status')
                                    ->placeholder('Pelanggan Setia'),
                                \Filament\Forms\Components\Select::make('rating')
                                    ->label('Rating')
                                    ->options([
                                        1 => '1 Bintang',
                                        2 => '2 Bintang',
                                        3 => '3 Bintang',
                                        4 => '4 Bintang',
                                        5 => '5 Bintang',
                                    ])
                                    ->required()
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
                                    ->disk('public')
                                    ->directory('testimonials')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(10240)
                                    ->imageEditor()
                                    ->imageResizeMode('cover')
                                    ->imageResizeTargetWidth(800)
                                    ->imageResizeTargetHeight(800)
                                    ->imageResizeUpscale(false),
                                Toggle::make('is_active')
                                    ->label('Tampilkan di Website')
                                    ->inline(false)
                                    ->default(true),
                            ]),
                    ]),
            ]);
    }
}
