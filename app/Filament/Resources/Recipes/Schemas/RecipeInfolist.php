<?php

namespace App\Filament\Resources\Recipes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RecipeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('servings')
                    ->label('Porzioni')
                    ->numeric(),

                TextEntry::make('instructions')
                    ->label('Istruzioni')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('ingredients_table')
                    ->label('Ingredienti')
                    ->state(function ($record): string {
                        $ingredients = $record->ingredients()->with(['category', 'unit'])->get();

                        if ($ingredients->isEmpty()) {
                            return '<em style="color: #6b7280">Nessun ingrediente</em>';
                        }

                        $rows = $ingredients->map(function ($ingredient) {
                            $optional = $ingredient->is_optional
                                ? ' <span style="color:#f59e0b; font-size:0.75rem">(opzionale)</span>'
                                : '';

                            return "
                                <tr style='border-bottom: 1px solid #374151'>
                                    <td style='padding: 6px 12px 6px 0'>{$ingredient->category->name}{$optional}</td>
                                    <td style='padding: 6px 12px; text-align:right'>{$ingredient->quantity_required_base}</td>
                                    <td style='padding: 6px 0 6px 12px; color:#9ca3af'>{$ingredient->unit->name}</td>
                                </tr>";
                        })->implode('');

                        return "
                            <table style='width:100%; border-collapse:collapse; font-size:0.9rem'>
                                <thead>
                                    <tr style='color:#9ca3af; font-size:0.75rem; text-transform:uppercase; border-bottom: 1px solid #4b5563'>
                                        <th style='padding: 4px 12px 4px 0; text-align:left; font-weight:500'>Ingrediente</th>
                                        <th style='padding: 4px 12px; text-align:right; font-weight:500'>Qtà</th>
                                        <th style='padding: 4px 0 4px 12px; text-align:left; font-weight:500'>Unità</th>
                                    </tr>
                                </thead>
                                <tbody>{$rows}</tbody>
                            </table>";
                    })
                    ->html()
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Creata il')
                    ->dateTime()
                    ->placeholder('-'),

                TextEntry::make('updated_at')
                    ->label('Aggiornata il')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
