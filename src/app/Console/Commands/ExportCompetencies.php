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

        // Load competencies array dynamically, adjust path as needed
        $path = base_path('database/data/competencias/' . ($program ? $program . '.php' : 'competencies.php'));

        if (!File::exists($path)) {
            $this->error("Competency file not found: $path");
            return Command::FAILURE;
        }

        $competencies = include $path;

        if (!is_array($competencies)) {
            $this->error('Invalid competency file format. It must return an array.');
            return Command::FAILURE;
        }

        $outputDir = base_path('database/data/generated/competencies/');
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0777, true);
        }

        foreach ($competencies as $competency) {
            if (!isset($competency['code'])) {
                $this->warn('Skipping competency without code field.');
                continue;
            }

            $filename = $competency['code'] . '.json';
            $filePath = $outputDir . '/' . $filename;

            $jsonData = json_encode($competency, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            if (File::exists($filePath)) {
                $existing = File::get($filePath);
                if ($existing === $jsonData) {
                    $this->info("No changes for {$competency['code']}, skipping.");
                    continue;
                }

                $this->info("Updating competency: {$competency['code']}");
            } else {
                $this->info("Creating competency: {$competency['code']}");
            }

            File::put($filePath, $jsonData);
        }

        $this->info('Export process completed successfully.');

        return Command::SUCCESS;
    }
}
