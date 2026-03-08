<?php

namespace App\Filament\Resources\ShoppingLists\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShoppingListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'name'),
                TextInput::make('custom_name'),
                TextInput::make('quantity')
                    ->numeric(),
                Select::make('unit_id')
                    ->relationship('unit', 'name'),
                Select::make('source')
                    ->options(['auto' => 'Auto', 'manual' => 'Manual'])
                    ->default('manual')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'bought' => 'Bought'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
