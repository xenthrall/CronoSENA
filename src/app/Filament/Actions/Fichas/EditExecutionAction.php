<?php

namespace App\Filament\Actions\Fichas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use Filament\Support\Enums\Alignment;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;




class EditExecutionAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'editExecution')
            ->label('Editar')
            ->icon('heroicon-o-pencil')
            ->color('primary')
            ->modalHeading(fn($record) => "Editar Ejecución del Instructor: " . $record->instructor->full_name)
            ->modalIcon('heroicon-o-pencil')
            ->modalSubmitActionLabel('Guardar cambios')
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('instructor_id')
                            ->label('Instructor')
                            ->options(fn() => Instructor::query()->orderBy('full_name')->pluck('full_name', 'id')->toArray())
                            ->searchable()
                            ->default(fn($record) => $record->instructor_id)
                            ->required(),
                        TextInput::make('executed_hours')
                            ->label('Horas ejecutadas')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(fn($record) => $record->fichaCompetency->remaining_hours + $record->executed_hours)
                            ->placeholder(fn($record) => "Máximo: " . ($record->fichaCompetency->remaining_hours + $record->executed_hours) . " horas")
                            ->default(fn($record) => $record->executed_hours)
                            ->required(),

                    ]),
                Grid::make(2)
                    ->schema([
                        DatePicker::make('execution_date')
                            ->label('Fecha de ejecución')
                            ->default(fn($record) => $record->execution_date)
                            ->required(),

                        DatePicker::make('completion_date')
                            ->label('Fecha de finalización')
                            ->default(fn($record) => $record->completion_date),
                    ]),

                Textarea::make('notes')
                    ->label('Notas')
                    ->default(fn($record) => $record->notes)
                    ->rows(4),
            ])
            ->modalAlignment(Alignment::Center)
            ->action(function (array $data, $record) {
                $record->update([
                    'instructor_id'       => $data['instructor_id'],
                    'execution_date'      => $data['execution_date'] ?? null,
                    'completion_date'     => $data['completion_date'] ?? null,
                    'executed_hours'      => $data['executed_hours'],
                    'notes'               => $data['notes'] ?? null,
                ]);
                    
            })
            ->successNotificationTitle('Ejecución actualizada correctamente');
    }
}
