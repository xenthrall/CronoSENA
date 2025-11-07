<?php

namespace App\Traits;

use App\Models\FichaCompetency;

trait ManagesFichaCompetencyProgress
{
    //Este trait puede contener métodos relacionados con la gestión del progreso de las competencias en fichas.

    protected function updateExecutedHours(FichaCompetency $fichaCompetency): void
    {
        $totalExecuted = $fichaCompetency->executions()->sum('executed_hours');

        $fichaCompetency->updateQuietly([
            'executed_hours' => $totalExecuted,
        ]);

        $this->updateStatusIfNeeded($fichaCompetency);
    }

    protected function updateStatusIfNeeded(FichaCompetency $fichaCompetency): void
    {
        // Reglas de estado según las horas ejecutadas
        $executed = (float) $fichaCompetency->executed_hours;
        $total = (float) $fichaCompetency->total_hours_competency;

        if ($total <= 0) {
            return;
        }

        $progress = ($executed / $total) * 100;

        if ($executed <= 0) {
            $newStatus = 'pendiente';
        } elseif ($progress >= 80) {
            $newStatus = 'completado';
        } else {
            $newStatus = 'en_progreso';
        }

        if ($fichaCompetency->status !== $newStatus) {
            $fichaCompetency->updateQuietly(['status' => $newStatus]);
        }
    }
}
