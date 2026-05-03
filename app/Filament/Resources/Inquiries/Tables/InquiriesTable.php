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
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')->dateTime('d M Y H:i')->sortable()->label('Tanggal'),
                TextColumn::make('name')->searchable()->label('Nama')->weight('bold'),
                TextColumn::make('phone')->searchable()->copyable()->label('No. WA')->icon('heroicon-o-phone'),
                TextColumn::make('location')->searchable()->label('Lokasi'),
                TextColumn::make('product.name')->searchable()->label('Produk')->limit(25)->badge()->color('warning'),
                TextColumn::make('message')->label('Pesan/Opsi')->limit(60)->wrap()->placeholder('—'),
                SelectColumn::make('status')
                    ->options([
                        'new' => '🔵 Baru',
                        'contacted' => '🟡 Dihubungi',
                        'closed' => '🟢 Selesai',
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
