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
                TextColumn::make('code')
                    ->label('Ficha')
                    ->extraAttributes(['class' => 'font-medium'])
                    ->searchable(),

                // Programa — muestra "code - name"
                TextColumn::make('program.name')
                    ->label('Programa')
                    /*->getStateUsing(fn ($record) => $record->programa
                        ? "{$record->programa->codigo_programa} - {$record->programa->nombre}"
                        : '-')*/
                    ->searchable(),

                // Fechas
                TextColumn::make('start_date')
                    ->label('Inicio')
                    ->date('d/F/Y')
                    ->sortable(),

                TextColumn::make('lective_end_date')
                    ->label('Fin lectiva')
                    ->date('d/F/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('end_date')
                    ->label('Fin total')
                    ->date('d/F/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status.name')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('municipality.name')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('shift.name')
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
                SelectFilter::make('status_id')
                    ->label('Estado')
                    ->relationship('status', 'name'),

                // Filtrar por jornada (select con relación)
                SelectFilter::make('shift_id')
                    ->label('Jornada')
                    ->relationship('shift', 'name'),

                /*/ Rango de fechas de inicio
                Filter::make('start_date_range')
                    ->form([
                        DatePicker::make('start_date_from')->label('Desde'),
                        DatePicker::make('start_date_to')->label('Hasta'),
                    ])
                    ->query(function ($query, $data) {
                        if ($data['start_date_from']) {
                            $query->whereDate('start_date', '>=', $data['start_date_from']);
                        }
                        if ($data['start_date_to']) {
                            $query->whereDate('start_date', '<=', $data['start_date_to']);
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
