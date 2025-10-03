<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Programa;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Programa::create([
            'codigo_programa' => '228118',
            'nombre' => ' ANALISIS Y DESARROLLO DE SOFTWARE',
            'duracion_total_horas' => 3984,
            'version' => '1',
            'nivel_formacion_id' => 4,
            'nombre_programa_especial_id' => 3,
        ]);
    }
}
