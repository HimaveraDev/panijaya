<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Produk'),
                TextInput::make('name')->required()->label('Nama Pelanggan'),
                TextInput::make('phone')->required()->label('No. WhatsApp'),
                TextInput::make('location')->required()->label('Lokasi/Kota'),
                Textarea::make('message')
                    ->label('Pesan / Detail Pesanan')
                    ->rows(5)
                    ->columnSpanFull()
                    ->placeholder('Detail opsi dan estimasi harga dari pelanggan'),
                Select::make('status')
                    ->label('Status Tindak Lanjut')
                    ->options([
                        'new' => '🔵 Baru (Belum Ditangani)',
                        'contacted' => '🟡 Sudah Dihubungi',
                        'closed' => '🟢 Selesai / Deal',
                    ])
                    ->default('new')
                    ->required(),
            ]);
    }
}
