<?php

namespace App\Filament\Resources\SupermarketLayouts\Pages;

use App\Filament\Resources\SupermarketLayouts\SupermarketLayoutResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSupermarketLayout extends EditRecord
{
    protected static string $resource = SupermarketLayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
