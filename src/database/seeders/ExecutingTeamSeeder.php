<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExecutingTeam;

class ExecutingTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExecutingTeam::create([
            'name' => 'Planta',
            'description' => '',
        ]);

        ExecutingTeam::create([
            'name' => 'Contrato',
            'description' => '',
        ]);
    }
}
