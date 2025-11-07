<?php

namespace App\Filament\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;


class RegisterExecutionAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'registerExecution')
            ->label('Registrar Ejecución')
            ->icon('heroicon-o-clock')
            ->color('success')
            ->modalHeading('Registrar ejecución de competencia')
            ->schema([
                Select::make('instructor_id')
                    ->label('Instructor')
                    ->options(fn() => Instructor::query()->orderBy('name')->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),

                DatePicker::make('execution_date')
                    ->label('Fecha de ejecución')
                    ->required(),

                DatePicker::make('completion_date')
                    ->label('Fecha de finalización'),

                TextInput::make('executed_hours')
                    ->label('Horas ejecutadas')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Textarea::make('notes')
                    ->label('Notas')
                    ->rows(3),
            ])
            ->action(function (array $data, $record) {
                FichaCompetencyExecution::create([
                    'ficha_competency_id' => $record->id,
                    'instructor_id'       => $data['instructor_id'],
                    'execution_date'      => $data['execution_date'] ?? null,
                    'completion_date'     => $data['completion_date'] ?? null,
                    'executed_hours'      => $data['executed_hours'],
                    'notes'               => $data['notes'] ?? null,
                ]);

                $this->success();
                $this->notify('success', 'Ejecución registrada correctamente.');
            });
    }
}
