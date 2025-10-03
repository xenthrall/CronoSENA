<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NivelFormacion;

class NivelFormacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NivelFormacion::create([
            'nombre' => 'AUXILIAR',
        ]);
        NivelFormacion::create([
            'nombre' => 'OPERARIO',
        ]);
        NivelFormacion::create([
            'nombre' => 'TECNICO',
        ]);
        NivelFormacion::create([
            'nombre' => 'TECNOLOGO',
        ]);
        
    }
}
