<?php

namespace App\Filament\Resources\ProjectGalleries;

use App\Filament\Resources\ProjectGalleries\Pages\CreateProjectGallery;
use App\Filament\Resources\ProjectGalleries\Pages\EditProjectGallery;
use App\Filament\Resources\ProjectGalleries\Pages\ListProjectGalleries;
use App\Filament\Resources\ProjectGalleries\Schemas\ProjectGalleryForm;
use App\Filament\Resources\ProjectGalleries\Tables\ProjectGalleriesTable;
use App\Models\ProjectGallery;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProjectGalleryResource extends Resource
{
    protected static ?string $model = ProjectGallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ProjectGalleryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectGalleriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectGalleries::route('/'),
            'create' => CreateProjectGallery::route('/create'),
            'edit' => EditProjectGallery::route('/{record}/edit'),
        ];
    }
}
