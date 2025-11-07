<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            #Usuarios base para el sistema
            UserSeeder::class,
            #Datos iniciales para el sistema
            CompetencyTypeSeeder::class,
            CompetencySeeder::class,
            TrainingLevelSeeder::class,
            SpecialProgramNameSeeder::class,
            ProgramSeeder::class,
            ProgramCompetencySeeder::class,
            MunicipalitySeeder::class,
            ShiftSeeder::class,
            FichaStatusSeeder::class,
            ExecutingTeamSeeder::class,

        ]);
    }
}
