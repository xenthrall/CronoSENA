<?php

namespace App\Filament\Resources\TipoCompetencias;

use App\Filament\Resources\TipoCompetencias\Pages\CreateTipoCompetencia;
use App\Filament\Resources\TipoCompetencias\Pages\EditTipoCompetencia;
use App\Filament\Resources\TipoCompetencias\Pages\ListTipoCompetencias;
use App\Filament\Resources\TipoCompetencias\Schemas\TipoCompetenciaForm;
use App\Filament\Resources\TipoCompetencias\Tables\TipoCompetenciasTable;
use App\Models\TipoCompetencia;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TipoCompetenciaResource extends Resource
{
    protected static ?string $model = TipoCompetencia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return TipoCompetenciaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipoCompetenciasTable::configure($table);
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
            'index' => ListTipoCompetencias::route('/'),
            'create' => CreateTipoCompetencia::route('/create'),
            'edit' => EditTipoCompetencia::route('/{record}/edit'),
        ];
    }
}
