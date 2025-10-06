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
        TrainingLevel::create([
            'name' => 'AUXILIAR',
        ]);
        TrainingLevel::create([
            'name' => 'OPERARIO',
        ]);
        TrainingLevel::create([
            'name' => 'TECNICO',
        ]);
        TrainingLevel::create([
            'name' => 'TECNOLOGO',
        ]);
        
    }
}
