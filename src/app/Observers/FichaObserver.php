<?php

namespace App\Observers;

use App\Models\Ficha;
use App\Models\FichaCompetency;
use Illuminate\Support\Facades\Log;


class FichaObserver
{
    /**
     * Handle the Ficha "created" event.
     */
    public function created(Ficha $ficha): void
    {
        // Cargar la relación con el programa y sus competencias
        $ficha->load('program.competencies');
        $program = $ficha->program;
        if (!$program || $program->competencies->isEmpty()) {
            Log::warning("Ficha {$ficha->id} creada sin competencias asociadas.");
            return;
        }
        // Preparar los datos para la inserción masiva
        $competenciasParaInsertar = $program->competencies->map(function ($competency) use ($ficha) {
            return [
                'ficha_id' => $ficha->id,
                'competency_id' => $competency->id,
                'total_hours_competency' => $competency->duration_hours,
                'executed_hours' => 0,
                'status' => 'pendiente', //estado por defecto
                'order' => 0, // Más adelante puede definir una lógica para el orden si es necesario
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        FichaCompetency::insert($competenciasParaInsertar->toArray());
    }

    /**
     * Handle the Ficha "updated" event.
     */
    public function updated(Ficha $ficha): void
    {
        //
    }

    /**
     * Handle the Ficha "deleted" event.
     */
    public function deleted(Ficha $ficha): void
    {
        //
    }

    /**
     * Handle the Ficha "restored" event.
     */
    public function restored(Ficha $ficha): void
    {
        //
    }

    /**
     * Handle the Ficha "force deleted" event.
     */
    public function forceDeleted(Ficha $ficha): void
    {
        //
    }
}
