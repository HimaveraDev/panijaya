<?php

namespace App\Filament\Resources\Inquiries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class InquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->dateTime()->sortable()->label('Tanggal'),
                TextColumn::make('name')->searchable()->label('Nama Prospek'),
                TextColumn::make('phone')->searchable()->copyable()->label('No. WA'),
                TextColumn::make('location')->searchable()->label('Lokasi'),
                TextColumn::make('product.name')->searchable()->label('Produk Terkait')->limit(20),
                SelectColumn::make('status')
                    ->options([
                        'new' => 'Baru',
                        'contacted' => 'Dihubungi',
                        'closed' => 'Selesai',
                    ]),
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
