<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shifts')->insert([
            [
                'name' => 'Diurna',
                'description' => 'De 6:00am a 6:00pm, lunes a viernes',
                'start_time' => '06:00:00',
                'end_time' => '18:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
            [
                'name' => 'Mañana',
                'description' => 'De 6:00am a 1:00pm, lunes a viernes',
                'start_time' => '06:00:00',
                'end_time' => '13:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
            [
                'name' => 'Tarde',
                'description' => 'De 12:00pm a 6:00pm, lunes a viernes',
                'start_time' => '12:00:00',
                'end_time' => '18:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
            [
                'name' => 'Nocturna',
                'description' => 'De 6:00pm a 10:00pm, lunes a viernes',
                'start_time' => '18:00:00',
                'end_time' => '22:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
            [
                'name' => 'Madrugada',
                'description' => 'De 10:00pm a 6:00am, lunes a viernes',
                'start_time' => '22:00:00',
                'end_time' => '06:00:00', // al día siguiente
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
            [
                'name' => 'Fin de Semana',
                'description' => 'De 6:00am a 6:00pm, sábados y domingos',
                'start_time' => '06:00:00',
                'end_time' => '18:00:00',
                'is_mixed' => false,
                'segments' => null,
                'valid_days' => json_encode(['Sábado','Domingo']),
                'is_active' => true,
            ],
            [
                'name' => 'Mixta',
                'description' => 'De 6:00am a 12:00pm y 1:00pm a 6:00pm, lunes a viernes',
                'start_time' => null, // porque es compuesta
                'end_time' => null,
                'is_mixted' => true,
                'segments' => json_encode([
                    ['inicio' => '06:00:00', 'fin' => '12:00:00'],
                    ['inicio' => '13:00:00', 'fin' => '18:00:00'],
                ]),
                'valid_days' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'is_active' => true,
            ],
        ]);
    }
}
