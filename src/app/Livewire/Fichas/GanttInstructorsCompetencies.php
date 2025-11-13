<?php

namespace App\Livewire\Fichas;

use App\Livewire\Base\GanttBaseComponent;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class GanttInstructorsCompetencies extends GanttBaseComponent
{
    public ?int $fichaId = null;

     public function configure(): static
    {
        return $this
            ->entityName('Instructor')
            ->dayWidth(40)
            ->rowHeight(52);
    }

    /**
     * Obtiene las ejecuciones de competencias de los instructores en el rango del mes.
     */
    protected function fetchRecords(Carbon $periodStart, Carbon $periodEnd): Collection
    {
        return FichaCompetencyExecution::query()
            ->with(['fichaCompetency.ficha', 'fichaCompetency.competency', 'instructor'])
            ->when($this->fichaId, fn($q) =>
                $q->whereHas('fichaCompetency', fn($sq) => $sq->where('ficha_id', $this->fichaId))
            )
            ->where(function ($q) use ($periodStart, $periodEnd) {
                $q->whereBetween('execution_date', [$periodStart, $periodEnd])
                    ->orWhere(function ($q2) use ($periodStart, $periodEnd) {
                        $q2->whereNotNull('completion_date')
                            ->where('execution_date', '<=', $periodEnd)
                            ->where('completion_date', '>=', $periodStart);
                    })
                    ->orWhere(function ($q3) use ($periodEnd) {
                        $q3->whereNull('completion_date')
                            ->where('execution_date', '<=', $periodEnd);
                    });
            })
            ->get();
    }

    /**
     * Procesa los registros y construye las barras agrupadas por instructor.
     */
    protected function buildBars(Collection|array $records, Carbon $periodStart, Carbon $periodEnd): void
    {
        // Entidades: instructores con ejecuciones
        $this->entities = Instructor::query()
            ->whereIn('id', $records->pluck('instructor_id')->unique())
            ->orderBy('full_name')
            ->get();

        // Barras asociadas a cada entidad (instructor)
        $this->barsByEntity = [];

        foreach ($this->entities as $instructor) {
            $this->barsByEntity[$instructor->id] = [];

            foreach ($records->where('instructor_id', $instructor->id) as $exec) {
                $execStart = Carbon::parse($exec->execution_date)->startOfDay();
                $execEnd = $exec->completion_date
                    ? Carbon::parse($exec->completion_date)->endOfDay()
                    : $execStart;

                // Limitar rango al periodo visible
                $visibleStart = $execStart->max($periodStart);
                $visibleEnd = $execEnd->min($periodEnd);

                if ($visibleEnd->lt($visibleStart)) continue;

                $offset = $periodStart->diffInDays($visibleStart);
                $duration = $visibleStart->diffInDays($visibleEnd) + 1;

                $this->barsByEntity[$instructor->id][] = [
                    'left' => ($offset / $this->totalDays) * 100,
                    'width' => ($duration / $this->totalDays) * 100,
                    'label' => $exec->fichaCompetency->competency->name ?? 'Competencia',
                    'ficha_code' => $exec->fichaCompetency->ficha->code ?? 'N/A',
                    //'color' => '#208a0bff',
                    'started_at' => $execStart->toDateString(),
                    'ended_at' => $execEnd->toDateString(),
                ];
            }
        }
    }

    

}
