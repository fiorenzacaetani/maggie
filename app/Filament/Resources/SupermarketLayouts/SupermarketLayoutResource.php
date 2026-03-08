<?php

namespace App\Filament\Resources\SupermarketLayouts;

use App\Filament\Resources\SupermarketLayouts\Pages\CreateSupermarketLayout;
use App\Filament\Resources\SupermarketLayouts\Pages\EditSupermarketLayout;
use App\Filament\Resources\SupermarketLayouts\Pages\ListSupermarketLayouts;
use App\Filament\Resources\SupermarketLayouts\Pages\ViewSupermarketLayout;
use App\Filament\Resources\SupermarketLayouts\Schemas\SupermarketLayoutForm;
use App\Filament\Resources\SupermarketLayouts\Schemas\SupermarketLayoutInfolist;
use App\Filament\Resources\SupermarketLayouts\Tables\SupermarketLayoutsTable;
use App\Models\SupermarketLayout;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SupermarketLayoutResource extends Resource
{
    protected static ?string $model = SupermarketLayout::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SupermarketLayoutForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SupermarketLayoutInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SupermarketLayoutsTable::configure($table);
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
            'index' => ListSupermarketLayouts::route('/'),
            'create' => CreateSupermarketLayout::route('/create'),
            'view' => ViewSupermarketLayout::route('/{record}'),
            'edit' => EditSupermarketLayout::route('/{record}/edit'),
        ];
    }
}
