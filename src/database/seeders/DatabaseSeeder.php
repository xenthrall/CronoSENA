<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            CompetencyTypeSeeder::class,
            CompetenciaSeeder::class,
            NombreProgramaEspecialSeeder::class,
            NivelFormacionSeeder::class,
            ProgramaSeeder::class,
            JornadaSeeder::class,
            EstadosFichaSeeder::class,

        ]);
    }
}
