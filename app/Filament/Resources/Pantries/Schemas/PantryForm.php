<?php

namespace App\Filament\Resources\Pantries\Schemas;

use App\Models\Product;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PantryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Prodotto')
                    ->options(Product::query()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('current_quantity_base')
                    ->label('Quantità attuale (unità base)')
                    ->numeric()
                    ->default(0)
                    ->required(),

                TextInput::make('min_threshold_base')
                    ->label('Soglia minima (unità base)')
                    ->numeric()
                    ->default(0)
                    ->required(),

                TextInput::make('avg_consumption_daily')
                    ->label('Consumo medio giornaliero')
                    ->numeric()
                    ->default(0)
                    ->required(),

                DateTimePicker::make('last_restock_date')
                    ->label('Ultimo rifornimento')
                    ->nullable(),
            ]);
    }
}
