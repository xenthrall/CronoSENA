<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\Norm;
use App\Models\Competency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class CompetencySeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/competencies');

        if (!File::exists($path)) {
            $this->command->error("❌ Carpeta no encontrada: {$path}");
            return;
        }

        $files = File::files($path);

        $totalCreated = 0;
        $totalSkipped = 0;
        $totalFiles = count($files);

        if ($totalFiles === 0) {
            $this->command->warn("⚠ No se encontraron archivos en: {$path}");
            return;
        }

        foreach ($files as $file) {
            $filename = pathinfo($file, PATHINFO_FILENAME);

            if (!str_contains($filename, '_v')) {
                $this->command->warn("⚠ Nombre inválido de archivo (se espera formato codigo_vX): {$filename} — se omite");
                continue;
            }

            [$programCode, $version] = explode('_v', $filename, 2);

            // Buscar el programa
            $program = Program::where('program_code', $programCode)
                ->where('version', $version)
                ->first();

            if (!$program) {
                $this->command->warn("⚠ Programa no encontrado: {$programCode} (v{$version}) — se omite el archivo {$filename}");
                continue;
            }

            // Cargar archivo
            $competencies = include $file;

            if (!is_array($competencies)) {
                $this->command->warn("⚠ Archivo inválido o no retorna un array: {$filename} — se omite");
                continue;
            }

            $created = 0;
            $skipped = 0;
            $rowIndex = 0;

            foreach ($competencies as $data) {
                $rowIndex++;

                // Validaciones mínimas
                $code = Arr::get($data, 'code');
                $name = Arr::get($data, 'name');
                $duration = Arr::get($data, 'duration_hours');

                if (empty($code) || empty($name) || $duration === null) {
                    $this->command->warn("⚠ Archivo {$filename} - fila {$rowIndex}: faltan campos obligatorios (code/name/duration_hours) — se omite");
                    $skipped++;
                    continue;
                }

                // Crear o buscar norma laboral
                $norm = Norm::firstOrCreate(
                    ['code' => $code],
                    [
                        'name'        => $name,
                        'description' => Arr::get($data, 'description'),
                    ]
                );

                // Evitar duplicados: misma norma en el mismo programa
                $exists = Competency::where('program_id', $program->id)
                    ->where('norm_id', $norm->id)
                    ->exists();

                if ($exists) {
                    $skipped++;
                    continue;
                }

                // Crear competencia
                Competency::create([
                    'program_id'         => $program->id,
                    'norm_id'            => $norm->id,
                    'competency_type_id' => Arr::get($data, 'competency_type_id'),
                    'name'               => $name,
                    'description'        => Arr::get($data, 'description'),
                    'duration_hours'     => (int) $duration,
                ]);

                $created++;
            }

            $totalCreated += $created;
            $totalSkipped += $skipped;

            $this->command->info("✔ Archivo: {$filename} — creadas: {$created}, omitidas: {$skipped}");
        }

        $this->command->info("Seeder completado. Archivos procesados: {$totalFiles}. Total creadas: {$totalCreated}. Total omitidas: {$totalSkipped}.");
    }
}
