<?php

namespace App\Livewire\Fichas;

use App\Livewire\Base\GanttBaseComponent;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use League\Csv\Query\Row;

class GanttInstructorsCompetencies extends GanttBaseComponent
{
    public ?string $fichaId = null;

    public function configure(): static
    {
        return $this
            ->entityName('Instructor')
            ->columnsWidth(50)
            ->rowHeight(70);
    }

    /**
     * Obtiene las ejecuciones de competencias de los instructores en el rango del mes.
     */
    protected function fetchRecords(Carbon $periodStart, Carbon $periodEnd): Collection
    {
        return FichaCompetencyExecution::query()
            ->with(['fichaCompetency.ficha', 'fichaCompetency.competency', 'instructor'])
            ->when(
                $this->fichaId,
                fn($q) =>
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
        $instructores = Instructor::query()
            ->whereIn('id', $records->pluck('instructor_id')->unique())
            ->orderBy('full_name')
            ->get();

        // Filas
        foreach ($instructores as $instructor) {
            $this->rows[$instructor->id] = [
                'id'        => $instructor->id,
                'label'     => $instructor->full_name,
                'sub_label' => $instructor->email,
                'avatarUrl' => $instructor->getFilamentAvatarUrl(),
            ];
        }

        // Barras agrupadas por fila
        $this->barsByRow = [];

        foreach ($this->rows as $row) {

            $this->barsByRow[$row['id']] = [];

            $executions = $records->where('instructor_id', $row['id']);

            foreach ($executions as $exec) {

                $execStart = Carbon::parse($exec->execution_date)->startOfDay();
                $execEnd = $exec->completion_date
                    ? Carbon::parse($exec->completion_date)->endOfDay()
                    : $execStart;

                $bar = $this->makeGanttBar(
                    meta: [
                        'label'     => $exec->fichaCompetency->competency->name ?? 'Competencia',
                        'sub_label' => $exec->fichaCompetency->ficha->code ?? 'N/A',
                        'badge'     => $exec->executed_hours . 'h',
                    ],
                    execStart: $execStart,
                    execEnd: $execEnd,
                    periodStart: $periodStart,
                    periodEnd: $periodEnd,
                    totalColumns: $this->totalColumns
                );

                if ($bar) {
                    $this->barsByRow[$row['id']][] = $bar;
                }
            }
        }
    }
}
