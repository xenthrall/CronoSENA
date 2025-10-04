<?php

namespace App\Filament\Resources\Fichas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class FichasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            //->defaultSort('fecha_inicio', 'desc')
            ->columns([
                TextColumn::make('codigo')
                    ->label('Ficha')
                    ->extraAttributes(['class' => 'font-medium'])
                    ->searchable(),
                
                // Programa — muestra "codigo_programa - nombre"
                TextColumn::make('programa.nombre')
                    ->label('Programa')
                    /*->getStateUsing(fn ($record) => $record->programa
                        ? "{$record->programa->codigo_programa} - {$record->programa->nombre}"
                        : '-')*/
                    ->searchable(),

                // Fechas
                TextColumn::make('fecha_inicio')
                    ->label('Inicio')
                    ->date('d/F/Y')
                    ->sortable(),

                TextColumn::make('fecha_fin_lectiva')
                    ->label('Fin lectiva')
                    ->date('d/F/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('fecha_fin')
                    ->label('Fin total')
                    ->date('d/F/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('estado.nombre')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('municipio.nombre')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('jornada.nombre')
                    ->toggleable(isToggledHiddenByDefault: false),

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
                // Filtrar por estado (select con relación)
                SelectFilter::make('estado_id')
                    ->label('Estado')
                    ->relationship('estado', 'nombre'),

                // Filtrar por jornada (select con relación)
                SelectFilter::make('jornada_id')
                    ->label('Jornada')
                    ->relationship('jornada', 'nombre'),

                /*/ Rango de fechas de inicio
                Filter::make('fecha_inicio_range')
                    ->form([
                        DatePicker::make('fecha_inicio_from')->label('Desde'),
                        DatePicker::make('fecha_inicio_to')->label('Hasta'),
                    ])
                    ->query(function ($query, $data) {
                        if ($data['fecha_inicio_from']) {
                            $query->whereDate('fecha_inicio', '>=', $data['fecha_inicio_from']);
                        }
                        if ($data['fecha_inicio_to']) {
                            $query->whereDate('fecha_inicio', '<=', $data['fecha_inicio_to']);
                        }
                    })
                    ->label('Rango fecha inicio'), */
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
