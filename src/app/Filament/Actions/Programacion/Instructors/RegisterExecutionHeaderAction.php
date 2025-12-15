<?php

namespace App\Filament\Actions\Programacion\Instructors;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\Alignment;
use Filament\Schemas\Components\Grid;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Filament\Notifications\Notification;

use App\Models\Ficha;
use App\Models\FichaCompetency;
use App\Models\FichaCompetencyExecution;

use App\Traits\Executions\PreventsDateOverlap;
use App\Traits\Executions\CalculatesExecutionHours;

class RegisterExecutionHeaderAction extends Action
{
    use PreventsDateOverlap;
    use CalculatesExecutionHours;

    protected ?int $instructorId = null;

    public function instructor(int $id): static
    {
        $this->instructorId = $id;
        return $this;
    }

    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'registerExecutionHeader')
            ->label('Registrar ejecución')
            ->icon('heroicon-o-clock')
            ->color('primary')
            ->modalHeading('Registrar ejecución')
            ->modalSubmitActionLabel('Guardar')
            ->modalAlignment(Alignment::Center)

            ->schema([
                /** Ficha y competencia */
                Grid::make(1)->schema([
                    Select::make('ficha_id')
                        ->label('Ficha')
                        ->searchable()
                        ->required()
                        ->reactive()
                        ->options(
                            fn () =>
                                Ficha::query()
                                    ->join('programs', 'programs.id', '=', 'fichas.program_id')
                                    ->selectRaw("
                                        fichas.id,
                                        CONCAT(fichas.code, ' — ', programs.name, ' v', programs.version) AS label
                                    ")
                                    ->orderBy('fichas.code')
                                    ->pluck('label', 'id')
                        )

                        ->afterStateUpdated(fn(callable $set) => $set('ficha_competency_id', null)),

                    Select::make('ficha_competency_id')
                        ->label('Competencia')
                        ->required()
                        ->searchable()
                        ->reactive()
                        ->options(
                            fn (callable $get) =>
                                FichaCompetency::query()
                                    ->where('ficha_id', $get('ficha_id'))
                                    ->with('competency')
                                    ->get()
                                    ->mapWithKeys(fn (FichaCompetency $fc) => [
                                        $fc->id => "{$fc->competency->name} — {$fc->remaining_hours} horas disponibles",
                                    ])
                        )
                        ->disabled(fn(callable $get) => ! $get('ficha_id')),
                ]),

                /** Fechas */
                Grid::make(2)->schema([
                    DatePicker::make('execution_date')
                        ->label('Fecha inicio')
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(
                            fn($state, callable $set, callable $get) =>
                            $set(
                                'executed_hours',
                                self::calculateWorkHoursBetweenDates($state, $get('completion_date'))
                            )
                        ),

                    DatePicker::make('completion_date')
                        ->label('Fecha fin')
                        ->required()
                        ->minDate(fn(callable $get) => $get('execution_date'))
                        ->reactive()
                        ->afterStateUpdated(
                            fn($state, callable $set, callable $get) =>
                            $set(
                                'executed_hours',
                                self::calculateWorkHoursBetweenDates($get('execution_date'), $state)
                            )
                        ),
                ]),

                /** Horas */
                TextInput::make('executed_hours')
                    ->label('Horas ejecutadas')
                    ->integer()
                    //->readOnly()
                    ->minValue(1)
                    //->maxValue(fn($record) => $record->remaining_hours)
                    ->maxValue(fn(callable $get) => self::calculateMaxExecutableHours(
                        $get('execution_date'),
                        $get('completion_date'),
                        FichaCompetency::find($get('ficha_competency_id'))->remaining_hours ?? 0
                    ))
                    ->placeholder(fn(callable $get) => "Máximo: " . (FichaCompetency::find($get('ficha_competency_id'))->remaining_hours ?? 0) . " horas")
                    ->reactive()
                    ->required(),

                /** Ambiente */
                Grid::make(2)->schema([
                    Select::make('location_id')
                        ->label('Sede')
                        ->searchable()
                        ->reactive()
                        ->options(fn() => self::obtenerUbicaciones()),

                    Select::make('training_environment_id')
                        ->label('Ambiente')
                        ->searchable()
                        ->options(
                            fn(callable $get) =>
                            self::findAvailableTrainingEnvironments(
                                $get('execution_date'),
                                $get('completion_date'),
                                $get('location_id')
                            )
                        ),
                ]),

            ])

            ->before(function (array $data, self $action) {

                $newStart = $data['execution_date'];
                $newEnd   = $data['completion_date'];

                $fichaId = $data['ficha_id'];
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

            ->action(function (array $data, self $action, $livewire) {
                FichaCompetencyExecution::create([
                    'ficha_competency_id'     => $data['ficha_competency_id'],
                    'instructor_id'           => $action->instructorId,
                    'training_environment_id' => $data['training_environment_id'] ?? null,
                    'execution_date'          => $data['execution_date'],
                    'completion_date'         => $data['completion_date'],
                    'executed_hours'          => $data['executed_hours'],
                    'notes'                   => $data['notes'] ?? null,
                ]);

                $livewire->dispatch('calendar-refresh');


            })

            ->successNotificationTitle('Ejecución registrada correctamente');
    }
}
