<?php

namespace App\Filament\Resources\Programas\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;


class CompetenciasRelationManager extends RelationManager
{
    protected static string $relationship = 'competencias';



    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_norma')
                    ->searchable(),
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('tipoCompetencia.nombre')
                    ->label('Tipo')
                    ->default('Sin asignar')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false) //  ocultar por defecto
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ]),
                TextColumn::make('duracion_horas')
                    ->label('Horas')
                    ->toggleable(isToggledHiddenByDefault: true), //  ocultar por defecto
            ])
            ->headerActions([
                // ...
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordTitle(fn($record) => "{$record->codigo_norma} - {$record->nombre}")
                    ->recordSelectSearchColumns(['codigo_norma', 'nombre'])
                    ->label('Vincular Competencia'),
            ])
            ->filters([
                //Filtrar por tipo de competencia
                SelectFilter::make('tipo_competencia_id')
                    ->label('Tipo de Competencia')
                    ->relationship('tipoCompetencia', 'nombre', hasEmptyOption: true)
                    ->emptyRelationshipOptionLabel('Sin asignar'),

            ])
            ->recordActions([
                // ...
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // ...
                    DetachBulkAction::make()
                        ->action(function ($records, $table) {
                            $relationship = $table->getRelationship();
                            // Aseguramos que sean IDs y no objetos
                            $relationship->detach($records->pluck('id'));
                        })
                    //->after(function ($records) { dd($records);})
                    ,
                ]),
            ]);
    }
}
