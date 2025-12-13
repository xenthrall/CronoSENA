<?php

namespace App\Traits\Executions;

use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use App\Models\TrainingEnvironment;

trait PreventsDateOverlap
{

    /**
     * Encontrar conflictos de rango de fechas para Ficha -> fichacompetencyexecution.
     */
    public static function findDateRangeConflict(string $modelClass, int $fichaId, string $startDate, string $endDate)
    {
        return $modelClass::query()
            ->whereHas('fichaCompetency', function ($query) use ($fichaId) {
                $query->where('ficha_id', $fichaId);
            })
            ->whereRaw(
                'DATE(execution_date) <= ? AND DATE(completion_date) >= ?',
                [$endDate, $startDate]
            )
            ->with(['fichaCompetency.competency', 'instructor'])
            ->first();
    }

    public static function findAvailableInstructors(?string $startDate = null, ?string $endDate = null): array
    {
        if (empty($startDate) || empty($endDate)) {
            return [];
        }

        $start = date('Y-m-d', strtotime($startDate));
        $end   = date('Y-m-d', strtotime($endDate));

        $conflictedInstructorIds = FichaCompetencyExecution::query()
            ->whereRaw(
                'DATE(execution_date) <= ? AND DATE(completion_date) >= ?',
                [$end, $start]
            )
            ->pluck('instructor_id')
            ->toArray();

        return Instructor::whereNotIn('id', $conflictedInstructorIds)
            ->orderBy('full_name')
            ->pluck('full_name', 'id')
            ->toArray();
    }

    public static function obtenerUbicaciones(): array
    {
        return \App\Models\Location::all()
            ->pluck('name', 'id')
            ->toArray();
    }

    public static function findAvailableTrainingEnvironments(?string $startDate = null, ?string $endDate = null, ?int $locationId = null): array
    {
        
        if (empty($locationId)) {
            return [];
        }

        return TrainingEnvironment::where('location_id', $locationId)
            ->pluck('code', 'id')
            ->toArray();
    }

}
