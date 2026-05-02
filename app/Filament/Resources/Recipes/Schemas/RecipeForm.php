<?php

namespace App\Filament\Resources\Recipes\Schemas;

use App\Models\Category;
use App\Models\Unit;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RecipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome ricetta')
                    ->required(),

                TextInput::make('servings')
                    ->label('Porzioni')
                    ->required()
                    ->numeric()
                    ->default(4),

                Textarea::make('instructions')
                    ->label('Istruzioni')
                    ->rows(5)
                    ->columnSpanFull(),

                Repeater::make('ingredients')
                    ->label('Ingredienti')
                    ->relationship('ingredients')
                    ->schema([
                        Select::make('category_id')
                            ->label('Ingrediente')
                            ->options(
                                Category::whereNotNull('parent_id')
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('quantity_required_base')
                            ->label('Quantità')
                            ->numeric()
                            ->required(),

                        Select::make('unit_id')
                            ->label('Unità')
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

                        Toggle::make('is_optional')
                            ->label('Opzionale')
                            ->default(false),
                    ])
                    ->columns(4)
                    ->addActionLabel('Aggiungi ingrediente')
                    ->columnSpanFull(),
            ]);
    }
}
