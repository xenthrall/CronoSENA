<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramCompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programId = 1;

        $data = [];
        for ($competencyId = 1; $competencyId <= 20; $competencyId++) {
            $data[] = [
                'program_id' => $programId,
                'competency_id' => $competencyId,
            ];
        }

        DB::table('program_competency')->insert($data);
    }
}
