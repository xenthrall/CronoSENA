<?php

namespace App\Filament\Resources\Competencies;

use App\Filament\Resources\Competencies\Pages\CreateCompetency;
use App\Filament\Resources\Competencies\Pages\EditCompetency;
use App\Filament\Resources\Competencies\Pages\ListCompetencies;
use App\Filament\Resources\Competencies\Schemas\CompetencyForm;
use App\Filament\Resources\Competencies\Tables\CompetenciesTable;
use App\Models\Competency;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CompetencyResource extends Resource
{
    protected static ?string $model = Competency::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|\UnitEnum|null $navigationGroup = 'programas';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Competencias';

    protected static ?string $modelLabel = 'Competencia';

    protected static ?string $pluralModelLabel = 'Competencias';

    public static function form(Schema $schema): Schema
    {
        return CompetencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompetenciesTable::configure($table);
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
            'index' => ListCompetencies::route('/'),
            'create' => CreateCompetency::route('/create'),
            'edit' => EditCompetency::route('/{record}/edit'),
        ];
    }
}
