<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ficha;
use App\Models\Shift;
use App\Models\SpecialProgramName;
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
            CompetencySeeder::class,
            TrainingLevelSeeder::class,
            SpecialProgramNameSeeder::class,
            MunicipalitySeeder::class,
            ShiftSeeder::class,
            FichaStatusSeeder::class,

        ]);
    }
}
