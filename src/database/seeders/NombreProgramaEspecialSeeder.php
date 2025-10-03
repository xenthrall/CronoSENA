<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NombreProgramaEspecial;

class NombreProgramaEspecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NombreProgramaEspecial::create([
            'nombre' => 'CAMPESENA',
        ]);

        NombreProgramaEspecial::create([
            'nombre' => 'FIC',
        ]);

        NombreProgramaEspecial::create([
            'nombre' => 'REGULAR',
        ]);

        NombreProgramaEspecial::create([
            'nombre' => 'REGULAR VIRTUAL',
        ]);

        NombreProgramaEspecial::create([
            'nombre' => 'VIRTUAL',
        ]);

    }
}
