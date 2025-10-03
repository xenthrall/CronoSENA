<?php

namespace App\Filament\Resources\Programas\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class ProgramasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_programa')
                    ->searchable(),
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('duracion_total_horas')
                    ->numeric()
                    ->label('Duración (Horas)'),
                TextColumn::make('nivelFormacion.nombre')
                    ->label('Nivel de Formación')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray' => fn($state): bool => $state === 'Sin asignar',
                        //'gray' => fn($state): bool => in_array($state, ['tecnico', 'Tecnólogo', 'Profesional']),
                    ])
                    ->icons([
                        'heroicon-m-x-circle' => fn($state): bool => $state === 'Sin asignar',
                    ]),
                TextColumn::make('nombreProgramaEspecial.nombre')
                    ->label('Nombre Programa Especial')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ])
                    ->icons([
                        'heroicon-m-x-circle' => fn($state): bool => $state === 'Sin asignar',
                    ]),

                TextColumn::make('version')
                    ->label('Versión')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //Filtras por nivel de formación
                SelectFilter::make('nivel_formacion_id')
                     ->label('Nivel de Formación')
                    ->relationship('nivelFormacion', 'nombre', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Sin asignar'),
                //Filtras por nombre de programa especial
                SelectFilter::make('nombre_programa_especial_id')
                    ->label('Nombre Programa Especial')
                    ->relationship('nombreProgramaEspecial', 'nombre', hasEmptyOption: true)
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
