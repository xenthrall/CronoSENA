<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Support\StorageHelper;

class CronosenaSetup extends Command
{
    protected $signature = 'cronosena:setup';
    protected $description = 'Run CronoSENA setup tasks';

    public function handle()
    {
        $environment = app()->environment();

        $this->info("Entorno detectado: {$environment}\n");

        if (app()->environment('local')) {
            $this->runLocalOptions();
        } else {
            $this->runProductionOptions();
        }

        return 0;
    }

    /**
     * Opciones disponibles solo en entorno local (desarrollo).
     */
    protected function runLocalOptions(): void
    {
        $this->info("===== Entorno de Desarrollo =====\n");
        $this->info("Seleccione una opción:");
        $this->info("  [1] Configuración inicial del proyecto");
        $this->info("  [2] Refrescar base de datos y poblarla");
        $this->info("  [3] Limpiar imágenes de perfil de instructores");
        $this->info("  [0] Salir\n");

        $option = $this->ask("Ingrese el número de la opción");

        switch ($option) {
            case '1':
                $this->initialSetup();
                break;

            case '2':
                $this->refreshDatabase();
                break;
            case '3':
                StorageHelper::cleanInstructorsProfiles();
                $this->info("✅ Imágenes de perfil de instructores eliminadas.");
                break;    

            case '0':
                $this->info("Saliendo...");
                return;

            default:
                $this->error("Opción no válida. Intente nuevamente.");
                $this->runLocalOptions(); // repetir menú
                break;
        }
    }


    /**
     * Opciones disponibles solo en producción.
     */
    protected function runProductionOptions(): void
    {
        $this->info("===== Entorno de Producción =====\n");
        $this->info("Seleccione una opción de mantenimiento:");
        $this->info("  [1] Sincronizar permisos del sistema");
        $this->info("  [0] Salir\n");

        $option = $this->ask("Ingrese el número de la opción");

        switch ($option) {
            case '1':
                $this->warn("Opcion en desarrollo.");
                break;

            case '0':
                $this->info("Saliendo...");
                return;

            default:
                $this->error("Opción no válida. Intente nuevamente.");
                $this->runProductionOptions(); // repetir menú
                break;
        }
    }


    /**
     * Initial project setup (local only).
     */
    protected function initialSetup(): void
    {
        $this->call('migrate');
        $this->call('cronosena:sync-permissions');
        $this->call('db:seed');
        $this->call('storage:link');

        $this->call('db:seed', [
            '--class' => 'InstructorSeeder',
            '--force' => true,
        ]);

        $this->info("✅ Configuración inicial completada.");
    }

    /**
     * Refresh the database (local only).
     */
    protected function refreshDatabase(): void
    {
        $this->call('migrate:refresh');
        $this->call('cronosena:sync-permissions');
        $this->call('db:seed');

        $this->call('db:seed', [
            '--class' => 'InstructorSeeder',
        ]);
        StorageHelper::cleanInstructorsProfiles();
        $this->info("✅ Imágenes de perfil de instructores eliminadas.");

        $this->info("✅ Base de datos refrescada y poblada.");
    }
}
