<?php

namespace App\Filament\Resources\ProgramacionInstructors;

use App\Filament\Resources\ProgramacionInstructors\Pages\ListProgramacionInstructors;
use App\Filament\Resources\ProgramacionInstructors\Tables\ProgramacionInstructorsTable;
use App\Models\Instructor;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ProgramacionInstructorResource extends Resource
{
    protected static ?string $model = Instructor::class;

     protected static ?string $navigationLabel = 'Instructores';

    protected static string|\UnitEnum|null $navigationGroup = 'programación';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $modelLabel = 'Instructor';

    protected static ?string $pluralModelLabel = 'Instructores';


    public static function table(Table $table): Table
    {
        return ProgramacionInstructorsTable::configure($table);
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
            'index' => ListProgramacionInstructors::route('/'),
        ];
    }
}
