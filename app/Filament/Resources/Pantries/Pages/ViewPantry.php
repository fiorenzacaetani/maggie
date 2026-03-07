<?php

namespace App\Filament\Resources\Pantries\Pages;

use App\Filament\Resources\Pantries\PantryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPantry extends ViewRecord
{
    protected static string $resource = PantryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
