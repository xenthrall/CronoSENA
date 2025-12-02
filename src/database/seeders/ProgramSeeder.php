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
            $program = Program::updateOrCreate(
                [
                    'program_code' => $data['program_code'],
                    'version' => $data['version'] ?? '1',
                ],
                $programData
            );

            // 3. Procesar competencias asociadas
            if (isset($data['competency_codes']) && is_array($data['competency_codes'])) {

                $competencyIds = [];
                $missingCodes = [];

                foreach ($data['competency_codes'] as $code) {
                    $competency = Competency::where('code', $code)->first();

                    if ($competency) {
                        $competencyIds[] = $competency->id;
                    } else {
                        $missingCodes[] = $code;
                    }
                }

                // 4. Asociar (sync mantiene el pivot limpio)
                if (!empty($competencyIds)) {
                    $program->competencies()->sync($competencyIds);
                }

                // 5. Reportar competencias no encontradas
                if (!empty($missingCodes)) {
                    $this->command->warn(
                        "Competencias no encontradas para el programa {$program->program_code}: " . 
                        implode(', ', $missingCodes)
                    );
                }
            }

            $contadorProgramas++;
        }

        $this->command->info("Programas procesados: {$contadorProgramas}");
    }
}
