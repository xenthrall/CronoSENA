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
            ['name' => 'CAPITANEJO '],
            ['name' => 'CARCASI 2'],
            ['name' => 'CERRITO 3'],
            ['name' => 'CONCEPCION 3'],
            ['name' => 'ENCISO 3'],
            ['name' => 'GUACA 3'],
            ['name' => 'MACARAVITA 3'],
            ['name' => 'MALAGA 3'],
            ['name' => 'MOLAGAVITA 3'],
            ['name' => 'SAN ANDRES 3'],
            ['name' => 'SAN JOSE DE MIRANDA 3'],
            ['name' => 'SAN MIGUEL  3'],
            ['name' => 'SOATA 3']
        ];
        foreach ($municipios as $municipio){
            Municipality::firstOrCreate(['name' => $municipio['name']], $municipio);
        }
    }
}
