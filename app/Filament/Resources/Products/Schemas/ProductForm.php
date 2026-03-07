<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Unit;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('ean')
                    ->label('EAN')
                    ->maxLength(13)
                    ->nullable(),

                TextInput::make('brand')
                    ->label('Marca')
                    ->maxLength(100)
                    ->nullable(),

                TextInput::make('name')
                    ->label('Nome')
                    ->maxLength(255)
                    ->required(),

                Select::make('base_unit_id')
                    ->label('Unità di misura')
                    ->options(function () {
                        $groups = [
                            'Peso'          => ['g', 'hg', 'kg'],
                            'Volume'        => ['ml', 'cl', 'l'],
                            'Conteggio'     => ['pz', 'conf', 'fette', 'mazzo'],
                            'Misure cucina' => ['cucch', 'cucch.ni', 'tazze', 'pizzico', 'spicchi', 'foglie'],
                        ];

                        $result = [];
                        $units = Unit::all()->keyBy('symbol');

                        foreach ($groups as $groupName => $symbols) {
                            foreach ($symbols as $symbol) {
                                if ($unit = $units->get($symbol)) {
                                    $result[$groupName][$unit->id] = "{$unit->name} ({$unit->symbol})";
                                }
                            }
                        }

                        return $result;
                    })
                    ->searchable()
                    ->required(),

                TextInput::make('content_value')
                    ->label('Contenuto (quantità per confezione)')
                    ->numeric()
                    ->nullable(),
            ]);
    }
}
