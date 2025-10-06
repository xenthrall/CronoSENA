<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competency;

class CompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Buscar todos los archivos PHP en el directorio database/data/competencias
        $files = glob(database_path('data/competencias/*.php'));
        foreach ($files as $file) {
            $competencias = require $file;

            foreach ($competencias as $data){
                Competency::create($data);
            }
        }
    }
}
