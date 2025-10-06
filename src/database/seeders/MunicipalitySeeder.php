<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            ['name' => 'Municipio 1'],
            ['name' => 'Municipio 2'],
            ['name' => 'Municipio 3'],
        ];
        foreach ($municipios as $municipio){
            Municipality::firstOrCreate(['name' => $municipio['name']], $municipio);
        }
    }
}
