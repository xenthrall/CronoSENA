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
        SpecialProgramName::create([
            'name' => 'CAMPESENA',
        ]);

        SpecialProgramName::create([
            'name' => 'FIC',
        ]);

        SpecialProgramName::create([
            'name' => 'REGULAR',
        ]);

        SpecialProgramName::create([
            'name' => 'REGULAR VIRTUAL',
        ]);

        SpecialProgramName::create([
            'name' => 'VIRTUAL',
        ]);

    }
}
