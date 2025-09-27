<?php

namespace App\Filament\Resources\Competencias;

use App\Filament\Resources\Competencias\Pages\CreateCompetencia;
use App\Filament\Resources\Competencias\Pages\EditCompetencia;
use App\Filament\Resources\Competencias\Pages\ListCompetencias;
use App\Filament\Resources\Competencias\Schemas\CompetenciaForm;
use App\Filament\Resources\Competencias\Tables\CompetenciasTable;
use App\Models\Competencia;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompetenciaResource extends Resource
{
    protected static ?string $model = Competencia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return CompetenciaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompetenciasTable::configure($table);
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
            'index' => ListCompetencias::route('/'),
            'create' => CreateCompetencia::route('/create'),
            'edit' => EditCompetencia::route('/{record}/edit'),
        ];
    }
}
