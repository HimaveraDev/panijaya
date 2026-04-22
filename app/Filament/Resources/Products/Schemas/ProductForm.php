<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048),
                RichEditor::make('description')
                    ->columnSpanFull(),
                Repeater::make('specifications')
                    ->schema([
                        TextInput::make('key')->label('Nama Kolom (Kunci)')->required(),
                        TextInput::make('value')->label('Isi Spesifikasi (Nilai)')->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->default(false),
                TextInput::make('base_price')
                    ->label('Harga Dasar')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp'),
                Section::make('Opsi Harga Tambahan')
                    ->schema([
                        Repeater::make('priceOptions')
                            ->relationship('priceOptions')
                            ->schema([
                                TextInput::make('label')
                                    ->required()
                                    ->label('Nama Opsi'),
                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->prefix('Rp')
                            ])
                            ->defaultItems(0)
                            ->columns(2)
                    ])
            ]);
    }
}
