<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportCompetencies extends Command
{
    protected $signature = 'competencies:export {program?}';
    protected $description = 'Export competencies into individual JSON files under data/competencies';

    public function handle()
    {
        $program = $this->argument('program');

        // Path dinámico del archivo fuente
        $path = base_path(
            'database/data/competencias/' . ($program ? $program . '.php' : 'competencies.php')
        );

        if (!File::exists($path)) {
            $this->error("Competency file not found: $path");
            return Command::FAILURE;
        }

        $competencies = include $path;

        if (!is_array($competencies)) {
            $this->error('Invalid competency file format. It must return an array.');
            return Command::FAILURE;
        }

        // Preguntar si se desea actualizar archivos existentes
        $shouldUpdate = $this->confirm(
            '¿Deseas actualizar los archivos JSON existentes si han cambiado?',
            false // Valor por defecto: NO
        );

        $outputDir = base_path('database/data/generated/competencies/');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0777, true);
        }

        // Lista de códigos procesados
        $processedCodes = [];

        foreach ($competencies as $competency) {
            if (!isset($competency['code'])) {
                $this->warn('Skipping competency without code field.');
                continue;
            }

            $code = $competency['code'];
            $processedCodes[] = $code;

            $filename = $code . '.json';
            $filePath = $outputDir . '/' . $filename;
            $jsonData = json_encode($competency, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            // Archivo ya existe
            if (File::exists($filePath)) {

                if (!$shouldUpdate) {
                    $this->info("El archivo {$filename} ya existe, saltando (sin actualizar)...");
                    continue;
                }

                // Comparar contenido
                $existingContent = File::get($filePath);
                if ($existingContent === $jsonData) {
                    $this->info("No hay cambios en {$filename}, saltando.");
                    continue;
                }

                $this->info("Actualizando competency: {$code}");
                File::put($filePath, $jsonData);
                continue;
            }

            // Crear archivo nuevo
            $this->info("Creando competency: {$code}");
            File::put($filePath, $jsonData);
        }

        // Mostrar lista final de códigos en formato JSON
        $this->newLine();
        $this->info("Códigos procesados:");
        $this->line(json_encode($processedCodes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->newLine();
        $this->info('Export process completed successfully.');

        return Command::SUCCESS;
    }
}
