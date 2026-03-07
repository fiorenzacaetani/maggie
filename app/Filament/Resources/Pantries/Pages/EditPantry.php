<?php

namespace App\Filament\Resources\Pantries\Pages;

use App\Filament\Resources\Pantries\PantryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPantry extends EditRecord
{
    protected static string $resource = PantryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
