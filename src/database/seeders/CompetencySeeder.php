<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competency;
use Illuminate\Support\Facades\File;

class CompetencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Directorio donde están los JSON generados
        $path = database_path('data/generated/competencies');

        // Buscar todos los archivos JSON en la carpeta
        $files = File::glob($path . '/*.json');

        $contadorCompetencias = 0;

        foreach ($files as $file) {
            // Decodificar JSON
            $data = json_decode(File::get($file), true);

            if (!$data || !isset($data['code'])) {
                $this->command->error("Archivo inválido o incompleto: {$file}");
                continue;
            }

            // Crear o actualizar si existe el mismo code + version
            Competency::updateOrCreate(
                [
                    'code' => $data['code'],
                    'version' => $data['version'] ?? '1',
                ],
                $data
            );

            $contadorCompetencias++;
        }

        $this->command->info('Competencias procesadas: ' . $contadorCompetencias);
    }
}