<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCompetencia; // 👈 Importa el modelo

class TiposCompetenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoCompetencia::create([
            'nombre' => 'Técnica',
            'descripcion' => 'Competencias específicas del área de conocimiento del programa. Son el núcleo de la formación técnica o tecnológica.',
        ]);

        TipoCompetencia::create([
            'nombre' => 'Transversal',
            'descripcion' => 'Competencias que desarrollan habilidades sociales, personales y productivas, como la comunicación, el trabajo en equipo y el emprendimiento. Son aplicables a diversos contextos laborales.',
        ]);

        TipoCompetencia::create([
            'nombre' => 'Básica',
            'descripcion' => 'Competencias que comprenden los conocimientos fundamentales en áreas como ciencias, matemáticas e informática, que sirven como base para el desarrollo de otras competencias.',
        ]);
    }
}
