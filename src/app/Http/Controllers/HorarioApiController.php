<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorarioApiController extends Controller
{
    public function eventsInstructor($id)
    {
        return response()->json([
            [
                'title' => 'Clase de Programación Avanzada',
                'start' => '2025-12-02T08:00:00',
                'end'   => '2025-12-02T10:00:00',
                
            ],
            [
                'title' => 'Reunión de Instructores',
                'start' => '2025-12-05T14:00:00',
                'end'   => '2025-12-05T15:00:00',
                
            ],
        ]);
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
