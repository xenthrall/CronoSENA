<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FichaCompetencyExecution;
use Carbon\Carbon;


class HorarioApiController extends Controller
{
    public function eventsInstructor($id)
    {
        $events = FichaCompetencyExecution::where('instructor_id', $id)
            ->with(['fichaCompetency.ficha', 'instructor'])
            ->get()
            ->map(function ($execution) {

                $shiftColor = $execution->fichaCompetency->ficha->shift->color;

                return [
                    'title' => sprintf(
                        'Ficha %s - %s',
                        $execution->fichaCompetency->ficha->code,
                        $execution->fichaCompetency->competency->name ?? ''
                    ),

                    'start' => Carbon::parse($execution->execution_date),

                    'end' => Carbon::parse($execution->completion_date),

                    'allDay' => true,

                    'color' => $shiftColor,

                    'extendedProps' => [
                        'shift' => $execution->fichaCompetency->ficha->shift->name,
                        'instructor' => $execution->instructor->full_name ?? null,
                        'notes' => $execution->notes,
                        'ficha_competency_id' => $execution->ficha_competency_id,
                    ],
                ];
            });

        return response()->json($events);
    }

    public function eventsFicha($id)
    {
        return response()->json([
            [
                'id' => 3,
                'title' => 'Formación Técnica',
                'start' => '2025-12-03T07:00:00',
                'end'   => '2025-12-03T11:00:00',
                'extendedProps' => [
                    'tooltip' => 'Ficha: ' . $id
                ],
            ],
            [
                'id' => 4,
                'title' => 'Evaluación Práctica',
                'start' => '2025-12-10T09:00:00',
                'end'   => '2025-12-10T11:00:00',
                'extendedProps' => [
                    'tooltip' => 'Evaluación parcial'
                ],
            ],
        ]);
    }

    public function eventsAmbiente($id)
    {
        return response()->json([
            [
                'id' => 5,
                'title' => 'Uso de Laboratorio',
                'start' => '2025-12-04T13:00:00',
                'end'   => '2025-12-04T17:00:00',
                'extendedProps' => [
                    'tooltip' => 'Ambiente: ' . $id
                ],
            ],
            [
                'id' => 6,
                'title' => 'Mantenimiento',
                'start' => '2025-12-12',
                'allDay' => true,
                'extendedProps' => [
                    'tooltip' => 'Mantenimiento preventivo'
                ],
            ],
        ]);
    }
}
