<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jornadas')->insert([
            [
                'nombre' => 'Diurna',
                'descripcion' => 'De 6:00am a 6:00pm, lunes a viernes',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '18:00:00',
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
            [
                'nombre' => 'Mañana',
                'descripcion' => 'De 6:00am a 1:00pm, lunes a viernes',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '13:00:00',
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
            [
                'nombre' => 'Tarde',
                'descripcion' => 'De 12:00pm a 6:00pm, lunes a viernes',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '18:00:00',
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
            [
                'nombre' => 'Nocturna',
                'descripcion' => 'De 6:00pm a 10:00pm, lunes a viernes',
                'hora_inicio' => '18:00:00',
                'hora_fin' => '22:00:00',
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
            [
                'nombre' => 'Madrugada',
                'descripcion' => 'De 10:00pm a 6:00am, lunes a viernes',
                'hora_inicio' => '22:00:00',
                'hora_fin' => '06:00:00', // al día siguiente
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
            [
                'nombre' => 'Fin de Semana',
                'descripcion' => 'De 6:00am a 6:00pm, sábados y domingos',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '18:00:00',
                'es_mixta' => false,
                'segmentos' => null,
                'dias_validos' => json_encode(['Sábado','Domingo']),
                'activo' => true,
            ],
            [
                'nombre' => 'Mixta',
                'descripcion' => 'De 6:00am a 12:00pm y 1:00pm a 6:00pm, lunes a viernes',
                'hora_inicio' => null, // porque es compuesta
                'hora_fin' => null,
                'es_mixta' => true,
                'segmentos' => json_encode([
                    ['inicio' => '06:00:00', 'fin' => '12:00:00'],
                    ['inicio' => '13:00:00', 'fin' => '18:00:00'],
                ]),
                'dias_validos' => json_encode(['Lunes','Martes','Miércoles','Jueves','Viernes']),
                'activo' => true,
            ],
        ]);
    }
}
