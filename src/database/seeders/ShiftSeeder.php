<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shifts = [
            [
                'name' => 'Mañana',
                'description' => 'De 7:00am a 12:00pm, lunes a viernes',
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
                'is_active' => true,
            ],
            [
                'name' => 'Tarde',
                'description' => 'De 2:00pm a 6:00pm, lunes a viernes',
                'start_time' => '14:00:00',
                'end_time' => '18:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
                'is_active' => true,
            ],
            [
                'name' => 'Nocturna',
                'description' => 'De 6:00pm a 10:00pm, lunes a viernes',
                'start_time' => '18:00:00',
                'end_time' => '22:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
                'is_active' => true,
            ],
            [
                'name' => 'Fin de Semana',
                'description' => 'De 6:00am a 6:00pm, sábados y domingos',
                'start_time' => '06:00:00',
                'end_time' => '18:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => ['Sábado','Domingo'],
                'is_active' => true,
            ],
            [
                'name' => 'Mixta',
                'description' => 'De 6:00am a 12:00pm y 1:00pm a 6:00pm, lunes a viernes',
                'start_time' => null,
                'end_time' => null,
                'is_mixed' => true,
                'segments' => [
                    ['inicio' => '07:00:00', 'fin' => '12:00:00'],
                    ['inicio' => '13:00:00', 'fin' => '18:00:00'],
                ],
                'valid_days' => ['Lunes','Martes','Miércoles','Jueves','Viernes'],
                'is_active' => true,
            ],
        ];

        foreach ($shifts as $shift) {
            Shift::firstOrCreate(
                ['name' => $shift['name']], // criterio de búsqueda
                [
                    'description' => $shift['description'],
                    'start_time' => $shift['start_time'],
                    'end_time' => $shift['end_time'],
                    'is_mixed' => $shift['is_mixed'],
                    'segments' => $shift['segments'] ? json_encode($shift['segments']) : null,
                    'valid_days' => json_encode($shift['valid_days']),
                    'is_active' => $shift['is_active'],
                ]
            );
        }
    }
}
