<?php

namespace App\Filament\Resources\SupermarketLayouts\Pages;

use App\Filament\Resources\SupermarketLayouts\SupermarketLayoutResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSupermarketLayout extends ViewRecord
{
    protected static string $resource = SupermarketLayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
