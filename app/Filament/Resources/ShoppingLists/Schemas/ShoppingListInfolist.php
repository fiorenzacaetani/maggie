<?php

namespace App\Filament\Resources\ShoppingLists\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ShoppingListInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product.name')
                    ->label('Product')
                    ->placeholder('-'),
                TextEntry::make('custom_name')
                    ->placeholder('-'),
                TextEntry::make('quantity')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('unit.name')
                    ->label('Unit')
                    ->placeholder('-'),
                TextEntry::make('source')
                    ->badge(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
