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
            ['name' => 'CAPITANEJO'],
            ['name' => 'CARCASI'],
            ['name' => 'CERRITO'],
            ['name' => 'CONCEPCION'],
            ['name' => 'ENCISO'],
            ['name' => 'GUACA'],
            ['name' => 'MACARAVITA'],
            ['name' => 'MALAGA'],
            ['name' => 'MOLAGAVITA'],
            ['name' => 'SAN ANDRES'],
            ['name' => 'SAN JOSE DE MIRANDA'],
            ['name' => 'SAN MIGUEL'],
            ['name' => 'SOATA']
        ];
        foreach ($municipios as $municipio) {
            Municipality::firstOrCreate(['name' => $municipio['name']], $municipio);
        }
    }
}
