<?php

namespace App\Filament\Resources\Pantries;

use App\Filament\Resources\Pantries\Pages\CreatePantry;
use App\Filament\Resources\Pantries\Pages\EditPantry;
use App\Filament\Resources\Pantries\Pages\ListPantries;
use App\Filament\Resources\Pantries\Pages\ViewPantry;
use App\Filament\Resources\Pantries\Schemas\PantryForm;
use App\Filament\Resources\Pantries\Schemas\PantryInfolist;
use App\Filament\Resources\Pantries\Tables\PantriesTable;
use App\Models\Pantry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PantryResource extends Resource
{
    protected static ?string $model = Pantry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PantryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PantryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PantriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPantries::route('/'),
            'create' => CreatePantry::route('/create'),
            'view' => ViewPantry::route('/{record}'),
            'edit' => EditPantry::route('/{record}/edit'),
        ];
    }
}
