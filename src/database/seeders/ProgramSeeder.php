<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'program_code' => '228118',
            'name' => ' ANALISIS Y DESARROLLO DE SOFTWARE',
            'total_duration_hours' => 3984,
            'version' => '1',
            'training_level_id' => 4,
            'special_program_name_id' => 3,
        ]);
    }
}
