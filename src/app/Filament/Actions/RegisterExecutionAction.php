<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use Filament\Support\Enums\Alignment;
use Filament\Schemas\Components\Grid;



class RegisterExecutionAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'registerExecution')
            ->label('Registrar Ejecución')
            ->icon('heroicon-o-clock')
            ->color('primary')
            ->modalHeading(fn($record) => "Registrar Ejecución para: " . $record->competency->name)
            ->modalIcon('heroicon-o-clock')
            ->modalSubmitActionLabel('Guardar ejecución')
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('instructor_id')
                            ->label('Instructor')
                            ->options(fn() => Instructor::query()->orderBy('name')->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->required(),
                        TextInput::make('executed_hours')
                            ->label('Horas ejecutadas')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(fn($record) => $record->remaining_hours)
                            ->placeholder(fn($record) => "Máximo: " . $record->remaining_hours . " horas")
                            ->required(),

                    ]),
                Grid::make(2)
                    ->schema([
                        DatePicker::make('execution_date')
                            ->label('Fecha de ejecución')
                            ->required(),

                        DatePicker::make('completion_date')
                            ->label('Fecha de finalización'),
                    ]),

                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(4),
            ])
            ->modalAlignment(Alignment::Center)
            ->action(function (array $data, $record) {
                FichaCompetencyExecution::create([
                    'ficha_competency_id' => $record->id,
                    'instructor_id'       => $data['instructor_id'],
                    'execution_date'      => $data['execution_date'] ?? null,
                    'completion_date'     => $data['completion_date'] ?? null,
                    'executed_hours'      => $data['executed_hours'],
                    'notes'               => $data['notes'] ?? null,
                ]);
                    
            })
            ->successNotificationTitle('Ejecución registrada correctamente');
    }
}
