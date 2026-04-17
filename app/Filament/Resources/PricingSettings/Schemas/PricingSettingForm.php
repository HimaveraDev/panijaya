<?php

namespace App\Filament\Resources\PricingSettings\Schemas;

use App\Models\PricingSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PricingSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Pricing')
                    ->description('Kombinasi jenis produk + material harus unik.')
                    ->columns(2)
                    ->schema([
                        Select::make('product_type')
                            ->label('Jenis Produk')
                            ->options(PricingSetting::PRODUCT_TYPES)
                            ->required()
                            ->native(false),

                        Select::make('material')
                            ->label('Material Kayu')
                            ->options(PricingSetting::MATERIALS)
                            ->required()
                            ->native(false),
                    ]),

                Section::make('Konfigurasi Harga')
                    ->columns(3)
                    ->schema([
                        TextInput::make('base_price')
                            ->label('Harga Dasar (Rp / m²)')
                            ->prefix('Rp')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->helperText('Harga dasar per m² sebelum dikalikan faktor material.'),

                        TextInput::make('min_price')
                            ->label('Harga Minimum (Rp)')
                            ->prefix('Rp')
                            ->numeric()
                            ->minValue(0)
                            ->required()
                            ->helperText('Floor harga — estimasi tidak akan turun dari nilai ini.'),

                        TextInput::make('material_factor')
                            ->label('Faktor Material')
                            ->numeric()
                            ->step(0.1)
                            ->minValue(0.1)
                            ->maxValue(9.99)
                            ->required()
                            ->helperText('Pengali: 1.0 = standar, >1 = premium, <1 = ekonomis.'),
                    ]),
            ]);
    }
}
