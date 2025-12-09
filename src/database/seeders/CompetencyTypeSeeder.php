<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompetencyType; // Importa el modelo

class CompetencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompetencyType::firstOrCreate([
            'name' => 'Técnica',
            'description' => 'Competencias específicas del área de conocimiento del programa. Son el núcleo de la formación técnica o tecnológica.',
        ]);

        CompetencyType::firstOrCreate([
            'name' => 'Transversal',
            'description' => 'Competencias que desarrollan habilidades sociales, personales y productivas, como la comunicación, el trabajo en equipo y el emprendimiento. Son aplicables a diversos contextos laborales.',
        ]);

        CompetencyType::firstOrCreate([
            'name' => 'Básica',
            'description' => 'Competencias que comprenden los conocimientos fundamentales en áreas como ciencias, matemáticas e informática, que sirven como base para el desarrollo de otras competencias.',
        ]);
    }
}
