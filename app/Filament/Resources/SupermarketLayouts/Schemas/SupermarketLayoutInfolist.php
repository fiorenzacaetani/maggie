<?php

namespace App\Filament\Resources\SupermarketLayouts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SupermarketLayoutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('retailer_name'),
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('aisle_order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
