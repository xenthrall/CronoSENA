<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipio;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            ['nombre' => 'Municipio 1'],
            ['nombre' => 'Municipio 2'],
            ['nombre' => 'Municipio 3'],
        ];
        foreach ($municipios as $municipio){
            Municipio::firstOrCreate(['nombre' => $municipio['nombre']], $municipio);
        }
    }
}
