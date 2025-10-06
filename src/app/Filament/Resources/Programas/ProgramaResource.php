<?php

namespace App\Filament\Resources\Programas;

use App\Filament\Resources\Programas\Pages\CreatePrograma;
use App\Filament\Resources\Programas\Pages\EditPrograma;
use App\Filament\Resources\Programas\Pages\ListProgramas;
use App\Filament\Resources\Programas\Schemas\ProgramaForm;
use App\Filament\Resources\Programas\Tables\ProgramasTable;
use App\Models\Programa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\Relation;

class ProgramaResource extends Resource
{
    protected static ?string $model = Programa::class;

    //protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?string $navigationLabel = 'Programas';


    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProgramaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\CompetenciasRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgramas::route('/'),
            'create' => CreatePrograma::route('/create'),
            'edit' => EditPrograma::route('/{record}/edit'),
        ];
    }
}
