<?php

namespace App\Filament\Resources\Norms;

use App\Filament\Resources\Norms\Pages\ManageNorms;
use App\Models\Norm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NormResource extends Resource
{
    protected static ?string $model = Norm::class;

    protected static ?string $navigationLabel = 'Normas Laborales';
    protected static ?string $pluralModelLabel = 'Normas Laborales';
    protected static ?string $modelLabel = 'Norma Laboral';
    protected static string|\UnitEnum|null $navigationGroup = 'programas';
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Código Norma Laboral')
                    ->unique()
                    ->required(),
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('code')
                    ->label('Código Norma Laboral')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->name)
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(80)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->tooltip(fn($record) => $record->description),
                TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([

                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageNorms::route('/'),
        ];
    }
}
