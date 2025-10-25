<?php

namespace App\Filament\Resources\Fichas;

use App\Filament\Resources\Fichas\Pages\CreateFicha;
use App\Filament\Resources\Fichas\Pages\EditFicha;
use App\Filament\Resources\Fichas\Pages\ListFichas;
use App\Filament\Resources\Fichas\Pages\ManageFicha;
use App\Filament\Resources\Fichas\Schemas\FichaForm;
use App\Filament\Resources\Fichas\Tables\FichasTable;
use App\Models\Ficha;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class FichaResource extends Resource
{
    protected static ?string $model = Ficha::class;

    protected static ?string $recordTitleAttribute = 'code';

    protected static string|\UnitEnum|null $navigationGroup = 'fichas';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Fichas';

    protected static ?string $modelLabel = 'Ficha';

    protected static ?string $pluralModelLabel = 'Fichas';

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
            'manage' => ManageFicha::route('/{record}/manage'),
        ];
    }

     public static function canViewAny(): bool
    {
        return Auth::user()?->can('ficha.view');
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->can('ficha.create');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->can('ficha.edit');
    }
}
