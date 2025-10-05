<?php

namespace App\Observers;

use App\Models\Ficha;
use App\Models\FichaCompetencia;
use Illuminate\Support\Facades\Log;


class FichaObserver
{
    /**
     * Handle the Ficha "created" event.
     */
    public function created(Ficha $ficha): void
    {
        // Cargar la relación con el programa y sus competencias
        $ficha->load('programa.competencias');
        $programa = $ficha->programa;
        if (!$programa || $programa->competencias->isEmpty()) {
            Log::warning("Ficha {$ficha->id} creada sin competencias asociadas.");
            return;
        }
        // Preparar los datos para la inserción masiva
        $competenciasParaInsertar = $programa->competencias->map(function ($competencia) use ($ficha) {
            return [
                'ficha_id' => $ficha->id,
                'competencia_id' => $competencia->id,
                'horas_totales_competencia' => $competencia->duracion_horas,
                'horas_ejecutadas' => 0,
                'estado' => 'pendiente', //estado por defecto
                'orden' => 0, // Más adelante puede definir una lógica para el orden si es necesario
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
        FichaCompetencia::insert($competenciasParaInsertar->toArray());
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
