<?php

namespace App\Filament\Resources\PricingSettings\Pages;

use App\Filament\Resources\PricingSettings\PricingSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPricingSetting extends EditRecord
{
    protected static string $resource = PricingSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
