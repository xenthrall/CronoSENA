<?php

namespace App\Filament\Resources\Competencies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class CompetenciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->limit(50) // corta el texto largo
                    ->tooltip(fn($record) => $record->name) //  muestra completo al pasar mouse
                    ->searchable(),

                TextColumn::make('competencyType.name')
                    ->label('Tipo')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ]),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(80) // corta el texto largo
                    ->toggleable(isToggledHiddenByDefault: true) //  ocultar por defecto
                    ->tooltip(fn($record) => $record->description), //  muestra completo al pasar mouse

                TextColumn::make('duration_hours')
                    ->label('Horas'),

                TextColumn::make('version')
                    ->label('Versión')
                    ->toggleable(isToggledHiddenByDefault: true),


                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //Filtrar por tipo de competencia
                SelectFilter::make('competency_type_id')
                    ->label('Tipo de Competencia')
                    ->relationship('competencyType', 'name', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Sin asignar'),

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
