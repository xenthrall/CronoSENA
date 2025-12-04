<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Competency;
use Illuminate\Support\Facades\File;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data/programs');
        $files = File::glob($path . '/*.json');

        $contadorProgramas = 0;

        foreach ($files as $file) {
            $data = json_decode(File::get($file), true);

            if (!$data || !isset($data['program_code'])) {
                $this->command->error("Archivo inválido o incompleto: {$file}");
                continue;
            }

            // 1. Mapear campos que irán a Program
            $programData = [
                'program_code' => $data['program_code'],
                'name' => $data['name'],
                'total_duration_hours' => $data['total_duration_hours'],
                'version' => $data['version'] ?? '1',
                'training_level_id' => $data['training_level_id'],
                'special_program_name_id' => $data['special_program_name_id'],
            ];

            // 2. Crear o actualizar programa
            Program::updateOrCreate(
                [
                    'program_code' => $data['program_code'],
                    'version' => $data['version'] ?? '1',
                ],
                $programData
            );

            

            $contadorProgramas++;
        }

        $this->command->info("Programas procesados: {$contadorProgramas}");
    }
}
