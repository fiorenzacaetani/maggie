<?php

namespace App\Filament\Resources\ShoppingLists\Schemas;

use App\Models\Unit;
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
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload(),
                TextInput::make('custom_name'),
                TextInput::make('quantity')
                    ->numeric(),


                // TODO: la lista dei simboli è hardcoded — le unità aggiunte al db non compaiono
                // automaticamente. Soluzione: aggiungere colonna `group` a tabella `units` e
                // raggruppare dinamicamente con Unit::all()->groupBy('group').
                // Vedi Story da creare in backlog Epica 1 o Epica 5.
                Select::make('unit_id')
                    ->label('Unità di misura')
                    ->options(function () {
                        $groups = [
                            'Peso'          => ['g', 'hg', 'kg'],
                            'Volume'        => ['ml', 'cl', 'l'],
                            'Conteggio'     => ['pz', 'conf', 'fette', 'mazzo'],
                            'Misure cucina' => ['cucch', 'cucch.ni', 'tazze', 'pizzico', 'spicchi', 'foglie', 'dozzina', '1/2 dozzina'],
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
                    ->searchable(),



                /*Select::make('unit_id')
                    ->relationship('unit', 'name'),*/




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
