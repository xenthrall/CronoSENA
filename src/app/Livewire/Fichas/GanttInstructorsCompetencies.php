<?php

namespace App\Livewire\Fichas;

use Livewire\Component;
use App\Models\Instructor;
use App\Models\FichaCompetencyExecution;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class GanttInstructorsCompetencies extends Component
{
    public int $month;
    public int $year;
    public ?int $fichaId = null;

    public int $dayWidthPx = 40;   // Ancho de cada día en píxeles
    public int $rowHeightPx = 54;  // Alto de cada fila/barras

    /** @var Collection<Instructor> */
    public Collection $instructors;

    /** @var array<int, array> */
    public array $barsByInstructor = [];

    /** @var array<int, Carbon> */
    public array $days = [];

    public int $totalDays = 0;

    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
    }

    public function mount(?int $fichaId = null, ?int $month = null, ?int $year = null): void
    {
        $now = Carbon::now();
        $this->fichaId = $fichaId;
        $this->month = $month ?? (int) $now->month;
        $this->year = $year ?? (int) $now->year;

        $this->refreshData();
    }

    /** 
     *  Un solo método que escucha cualquier cambio en month o year
     */
    public function updated($property): void
    {
        if (in_array($property, ['month', 'year'], true)) {
            $this->refreshData();
        }
    }

    /**
     * Carga toda la información necesaria para el gráfico.
     */
    protected function refreshData(): void
    {
        $monthStart = Carbon::create($this->year, $this->month, 1)->startOfDay();
        $monthEnd = $monthStart->clone()->endOfMonth()->endOfDay();

        $this->days = collect(range(0, $monthStart->diffInDays($monthEnd)))
            ->map(fn ($d) => $monthStart->clone()->addDays($d))
            ->toArray();

        $this->totalDays = count($this->days);

        $executions = $this->fetchExecutions($monthStart, $monthEnd);
        $this->instructors = $this->fetchInstructors($executions);

        $this->barsByInstructor = $this->buildBars($executions, $monthStart, $monthEnd);
    }

    /**
     * Obtiene las ejecuciones del mes filtradas por ficha (si aplica).
     */
    protected function fetchExecutions(Carbon $monthStart, Carbon $monthEnd)
    {
        return FichaCompetencyExecution::query()
            ->with(['fichaCompetency.ficha', 'fichaCompetency.competency', 'instructor'])
            ->when($this->fichaId, function ($q) {
                $q->whereHas('fichaCompetency', fn($sq) => $sq->where('ficha_id', $this->fichaId));
            })
            ->where(function ($q) use ($monthStart, $monthEnd) {
                $q->whereBetween('execution_date', [$monthStart, $monthEnd])
                    ->orWhere(function ($q2) use ($monthStart, $monthEnd) {
                        $q2->whereNotNull('completion_date')
                            ->where('execution_date', '<=', $monthEnd)
                            ->where('completion_date', '>=', $monthStart);
                    })
                    ->orWhere(function ($q3) use ($monthEnd) {
                        $q3->whereNull('completion_date')
                            ->where('execution_date', '<=', $monthEnd);
                    });
            })
            ->get();
    }

    /**
     * Obtiene los instructores que tienen ejecuciones.
     */
    protected function fetchInstructors(Collection $executions): Collection
    {
        $instructorIds = $executions->pluck('instructor_id')->filter()->unique();

        return Instructor::query()
            ->whereIn('id', $instructorIds)
            ->orderBy('full_name')
            ->get();
    }

    /**
     * Construye las barras visuales por instructor.
     */
    protected function buildBars(Collection $executions, Carbon $monthStart, Carbon $monthEnd): array
    {
        $bars = [];

        foreach ($this->instructors as $instructor) {
            $bars[$instructor->id] = [];

            foreach ($executions->where('instructor_id', $instructor->id) as $exec) {
                $execStart = Carbon::parse($exec->execution_date)->startOfDay();
                $execEnd = $exec->completion_date
                    ? Carbon::parse($exec->completion_date)->endOfDay()
                    : $execStart->clone();

                // Ajustar al rango del mes
                $start = $execStart->max($monthStart);
                $end = $execEnd->min($monthEnd);

                if ($end->lt($start)) {
                    continue; // sin superposición
                }

                $offset = $monthStart->diffInDays($start);
                $duration = $start->diffInDays($end) + 0;

                $bars[$instructor->id][] = [
                    'left' => ($offset / $this->totalDays) * 100,
                    'width' => ($duration / $this->totalDays) * 100,
                    'title' => ($exec->fichaCompetency->competency->name ?? 'Competencia')
                        . ' — Ficha '
                        . ($exec->fichaCompetency->ficha->code ?? 'N/A'),
                    'competency' => $exec->fichaCompetency->competency->name ?? 'Competencia',
                    'ficha_code' => $exec->fichaCompetency->ficha->code ?? 'N/A',
                    'notes' => $exec->notes,
                    'hours' => $exec->executed_hours ?? 0,
                    'color' => $exec->completion_date ? '#16a34a' : '#f59e0b',
                    'started_at' => $execStart->toDateString(),
                    'ended_at' => $execEnd->toDateString(),
                ];
            }
        }

        return $bars;
    }

    public function render()
    {
        return view('livewire.fichas.gantt-instructors-competencies', [
            'days' => $this->days,
            'instructors' => $this->instructors,
            'barsByInstructor' => $this->barsByInstructor,
            'monthLabel' => Carbon::create($this->year, $this->month, 1)->translatedFormat('F Y'),
            'totalDays' => $this->totalDays,
        ]);
    }
}
