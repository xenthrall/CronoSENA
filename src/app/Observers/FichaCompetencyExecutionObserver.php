<?php

namespace App\Observers;

use App\Models\FichaCompetencyExecution;
use App\Models\FichaCompetency;


class FichaCompetencyExecutionObserver
{
    /**
     * Handle the FichaCompetencyExecution "created" event.
     */
    public function created(FichaCompetencyExecution $execution): void
    {
        $this->updateExecutedHours($execution);
    }

    /**
     * Handle the FichaCompetencyExecution "updated" event.
     */
    public function updated(FichaCompetencyExecution $execution): void
    {
        $this->updateExecutedHours($execution);
    }

    /**
     * Handle the FichaCompetencyExecution "deleted" event.
     */
    public function deleted(FichaCompetencyExecution $execution): void
    {
        $this->updateExecutedHours($execution);
    }

    /**
     * Handle the FichaCompetencyExecution "restored" event.
     */
    public function restored(FichaCompetencyExecution $execution): void
    {
        //
    }

    /**
     * Handle the FichaCompetencyExecution "force deleted" event.
     */
    public function forceDeleted(FichaCompetencyExecution $fichaCompetencyExecution): void
    {
        //
    }

    /**
     * Recalcula las horas ejecutadas totales en la competencia asociada.
     */
    protected function updateExecutedHours(FichaCompetencyExecution $execution): void
    {
        // Verifica que exista la relación
        $fichaCompetency = $execution->fichaCompetency;

        if (! $fichaCompetency) {
            return;
        }

        // Suma todas las horas ejecutadas de esa competencia
        $totalExecuted = $fichaCompetency->executions()->sum('executed_hours');

        // Actualiza el valor en la tabla ficha_competencies
        $fichaCompetency->update([
            'executed_hours' => $totalExecuted,
        ]);
    }
}
