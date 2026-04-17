<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                    ->preload(),
                TextInput::make('name')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('location')->required(),
                Select::make('status')
                    ->options([
                        'new' => 'Baru (New)',
                        'contacted' => 'Sudah Dihubungi',
                        'closed' => 'Selesai / Deal',
                    ])
                    ->default('new')
                    ->required(),
            ]);
    }
}
