<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpecialProgramName;

class SpecialProgramNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpecialProgramName::firstOrCreate([
            'name' => 'CAMPESENA',
        ]);

        SpecialProgramName::firstOrCreate([
            'name' => 'FIC',
        ]);

        SpecialProgramName::firstOrCreate([
            'name' => 'REGULAR',
        ]);

        SpecialProgramName::firstOrCreate([
            'name' => 'REGULAR VIRTUAL',
        ]);

        SpecialProgramName::firstOrCreate([
            'name' => 'VIRTUAL',
        ]);

    }
}
