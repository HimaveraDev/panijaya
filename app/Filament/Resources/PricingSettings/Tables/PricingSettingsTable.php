<?php

namespace App\Filament\Resources\PricingSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use App\Models\PricingSetting;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class PricingSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_type')
                    ->label('Jenis Produk')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn (string $state): string => PricingSetting::PRODUCT_TYPES[$state] ?? $state)
                    ->sortable()
                    ->searchable(),

                TextColumn::make('material')
                    ->label('Material')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn (string $state): string => array_key_first(array_filter(PricingSetting::MATERIALS, fn ($v, $k) => $k === $state, ARRAY_FILTER_USE_BOTH)) !== null
                        ? PricingSetting::MATERIALS[$state]
                        : $state)
                    ->sortable()
                    ->searchable(),

                TextColumn::make('base_price')
                    ->label('Harga Dasar')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                TextColumn::make('min_price')
                    ->label('Harga Minimum')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                TextColumn::make('material_factor')
                    ->label('Faktor Material')
                    ->badge()
                    ->color(fn ($state) => $state >= 1.5 ? 'danger' : ($state >= 1.0 ? 'success' : 'gray'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
