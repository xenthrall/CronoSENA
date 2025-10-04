<?php

namespace App\Filament\Resources\Fichas;

use App\Filament\Resources\Fichas\Pages\CreateFicha;
use App\Filament\Resources\Fichas\Pages\EditFicha;
use App\Filament\Resources\Fichas\Pages\ListFichas;
use App\Filament\Resources\Fichas\Schemas\FichaForm;
use App\Filament\Resources\Fichas\Tables\FichasTable;
use App\Models\Ficha;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FichaResource extends Resource
{
    protected static ?string $model = Ficha::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'codigo';

    public static function form(Schema $schema): Schema
    {
        return FichaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FichasTable::configure($table);
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
            'index' => ListFichas::route('/'),
            'create' => CreateFicha::route('/create'),
            'edit' => EditFicha::route('/{record}/edit'),
        ];
    }
}
