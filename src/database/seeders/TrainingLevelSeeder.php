<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingLevel;

class TrainingLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainingLevel::firstOrCreate([
            'name' => 'AUXILIAR',
        ]);
        TrainingLevel::firstOrCreate([
            'name' => 'OPERARIO',
        ]);
        TrainingLevel::firstOrCreate([
            'name' => 'TECNICO',
        ]);
        TrainingLevel::firstOrCreate([
            'name' => 'TECNOLOGO',
        ]);
        
    }
}
