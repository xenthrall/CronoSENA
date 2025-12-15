<?php

namespace App\Filament\Instructor\Resources\Fichas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Ficha;
use App\Filament\Instructor\Resources\Fichas\FichaResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FichasTable
{
    public static function configure(Table $table): Table
    {
        $instructorId = Auth::id();
        return $table
            ->query(
                Ficha::query()
                    ->whereHas('instructorLeaderships', function ($q) use ($instructorId) {
                        $q->where('instructor_id', $instructorId)
                            ->whereNull('end_date'); 
                    })
            )

            ->recordUrl(function (Model $record): string {
                // Redirige a la página "manage" en lugar de "edit"
                return FichaResource::getUrl('manage', ['record' => $record]);
            })

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
