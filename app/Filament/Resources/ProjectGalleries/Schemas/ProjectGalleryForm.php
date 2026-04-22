<?php

namespace App\Filament\Resources\ProjectGalleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;

class ProjectGalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('location')
                    ->label('Location (Optional)')
                    ->maxLength(255),
                DatePicker::make('installation_date')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('projects')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
