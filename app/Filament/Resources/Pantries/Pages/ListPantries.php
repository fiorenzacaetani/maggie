<?php

namespace App\Filament\Resources\Pantries\Pages;

use App\Filament\Resources\Pantries\PantryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPantries extends ListRecords
{
    protected static string $resource = PantryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
