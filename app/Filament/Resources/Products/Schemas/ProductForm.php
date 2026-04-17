<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
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
                    ->directory('products'),
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
            ]);
    }
}
