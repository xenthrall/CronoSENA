<?php

namespace App\Filament\Instructor\Resources\Instructor\Examples;

use App\Filament\Instructor\Resources\Instructor\Examples\Pages\CreateExample;
use App\Filament\Instructor\Resources\Instructor\Examples\Pages\EditExample;
use App\Filament\Instructor\Resources\Instructor\Examples\Pages\ListExamples;
use App\Filament\Instructor\Resources\Instructor\Examples\Schemas\ExampleForm;
use App\Filament\Instructor\Resources\Instructor\Examples\Tables\ExamplesTable;
use App\Models\Instructor\Example;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExampleResource extends Resource
{
    protected static ?string $model = Example::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExampleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamplesTable::configure($table);
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
            'index' => ListExamples::route('/'),
            'create' => CreateExample::route('/create'),
            'edit' => EditExample::route('/{record}/edit'),
        ];
    }
}
