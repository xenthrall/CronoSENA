<?php

namespace App\Filament\Instructor\Resources\Fichas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FichasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Ficha')
                    ->extraAttributes(['class' => 'font-medium'])
                    ->searchable(),

                // Programa — muestra "code - name"
                TextColumn::make('program.name')
                    ->label('Programa')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->program->program_code . ' - ' . $record->program->name)
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
                    ->label('Estado')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('municipality.name')
                    ->label('Municipio')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->searchable(),

                TextColumn::make('shift.name')
                    ->label('Jornada')
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
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
