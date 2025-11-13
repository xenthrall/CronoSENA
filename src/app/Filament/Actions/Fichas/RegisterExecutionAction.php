<?php

namespace App\Filament\Actions\Fichas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use App\Models\FichaCompetencyExecution;
use Filament\Support\Enums\Alignment;
use Filament\Schemas\Components\Grid;

use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

use App\Traits\PreventsDateOverlap;


class RegisterExecutionAction extends Action
{
    use PreventsDateOverlap;

    public static function make(?string $name = null): static
    {

        return parent::make($name ?? 'registerExecution')
            ->label('Registrar Ejecución')
            ->icon('heroicon-o-clock')
            ->color('primary')
            ->modalHeading(fn($record) => "Registrar Ejecución para: " . $record->competency->name)
            ->modalIcon('heroicon-o-clock')
            ->modalSubmitActionLabel('Guardar ejecución')
            ->extraModalWindowAttributes([])
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('instructor_id')
                            ->label('Instructor')
                            ->options(fn(callable $get) => self::findAvailableInstructors(
                                $get('execution_date'),
                                $get('completion_date')
                            ))
                            //->disabled(fn(callable $get) => $get('is_valid_dates') === false)
                            //->disabled(fn(callable $get) => $get('execution_date') === null || $get('completion_date') === null) 
                            ->reactive()
                            ->searchable()
                            ->required(),
                        TextInput::make('executed_hours')
                            ->label('Horas ejecutadas')
                            ->integer()
                            ->minValue(1)
                            ->maxValue(fn($record) => $record->remaining_hours)
                            ->placeholder(fn($record) => "Máximo: " . $record->remaining_hours . " horas")
                            ->required(),

                    ]),
                Grid::make(2)
                    ->schema([
                        DatePicker::make('execution_date')
                            ->label('Fecha de ejecución')
                            ->reactive()
                            ->required(),

                        DatePicker::make('completion_date')
                            ->required()
                            ->reactive()
                            ->minDate(fn(callable $get) => $get('execution_date'))
                            ->label('Fecha de finalización'),
                    ]),
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
            ->before(function (array $data, $record) {
                $newStart = $data['execution_date'];
                $newEnd   = $data['completion_date'];

                $fichaId = $record->ficha_id;
                $conflict = self::findDateRangeConflict(
                    FichaCompetencyExecution::class,
                    $fichaId,
                    $newStart,
                    $newEnd
                );

                if ($conflict) {

                    // Datos del conflicto
                    $competencia = $conflict->fichaCompetency->competency->name ?? 'Competencia desconocida';
                    $instructor  = $conflict->instructor->full_name ?? 'Instructor no asignado';
                    $conflictStart = Carbon::parse($conflict->execution_date)->format('d/F/Y');
                    $conflictEnd   = Carbon::parse($conflict->completion_date)->format('d/F/Y');

                    $body = "
                        <strong>Conflicto de ejecución detectado</strong><br>
                        Esta ejecución se cruza con otra existente:<br><br>
                        • <strong>Competencia:</strong> {$competencia}<br>
                        • <strong>Instructor:</strong> {$instructor}<br>
                        • <strong>Desde:</strong> {$conflictStart} <br>
                        • <strong>Hasta:</strong> {$conflictEnd} <br>
                    ";

                    throw ValidationException::withMessages([
                        Notification::make()
                            ->danger()
                            ->title("Cruce de fechas")
                            ->body($body)
                            ->persistent()
                            ->send()
                    ]);
                }
            })

            ->successNotificationTitle('Ejecución registrada correctamente');
    }
}
