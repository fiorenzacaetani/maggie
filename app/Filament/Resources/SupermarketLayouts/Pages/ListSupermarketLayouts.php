<?php

namespace App\Filament\Resources\SupermarketLayouts\Pages;

use App\Filament\Resources\SupermarketLayouts\SupermarketLayoutResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSupermarketLayouts extends ListRecords
{
    protected static string $resource = SupermarketLayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
