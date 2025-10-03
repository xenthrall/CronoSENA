<?php

namespace App\Filament\Resources\Competencias\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class CompetenciasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo_norma')
                    ->label('Código')
                    ->searchable(),

                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),

                TextColumn::make('tipoCompetencia.nombre')
                    ->label('Tipo')
                    ->default('Sin asignar')
                    ->badge()
                    ->colors([
                        'gray'    => fn($state): bool => $state === 'Sin asignar', // si no tiene tipo asignado
                    ]),

                TextColumn::make('descripcion_norma')
                    ->label('Descripción')
                    ->limit(80) // corta el texto largo
                    ->toggleable(isToggledHiddenByDefault: true) //  ocultar por defecto
                    ->tooltip(fn($record) => $record->descripcion_norma), //  muestra completo al pasar mouse    

                TextColumn::make('duracion_horas')
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
                SelectFilter::make('tipo_competencia_id')
                    ->label('Tipo de Competencia')
                    ->relationship('tipoCompetencia', 'nombre', hasEmptyOption: true)
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
