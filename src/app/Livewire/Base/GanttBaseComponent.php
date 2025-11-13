<?php

namespace App\Livewire\Base;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Livewire\Base\Traits\HasGanttConfiguration;

abstract class GanttBaseComponent extends Component
{
    use HasGanttConfiguration;
    
    public int $month;
    public int $year;

    public int $dayWidthPx = 40;
    public int $rowHeightPx = 54;

    /** @var array<int, Carbon> */
    public array $days = [];

    public int $totalDays = 0;

    /** 
     * Colección de entidades (por ejemplo: instructores, fichas, proyectos, etc.)
     * @var Collection
     */
    public Collection $entities;

    /**
     * Barras asociadas a cada entidad.
     * Ejemplo: [entity_id => [bar1, bar2, ...]]
     */
    public array $barsByEntity = [];

    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));
    }

    public function mount(?int $month = null, ?int $year = null): void
    {
        $now = Carbon::now();
        $this->month = $month ?? (int) $now->month;
        $this->year = $year ?? (int) $now->year;

        $this->configure();
        $this->refreshData();
        
    }

    /**
     * Escucha cambios en propiedades clave (month, year)
     */
    public function updated($property): void
    {
        if (in_array($property, ['month', 'year'], true)) {
            $this->refreshData();
        }
    }

    /**
     * Refresca toda la información del Gantt.
     */
    protected function refreshData(): void
    {
        $periodStart = Carbon::create($this->year, $this->month, 1)->startOfDay();
        $periodEnd = $periodStart->clone()->endOfMonth()->endOfDay();

        $this->days = collect(range(0, $periodStart->diffInDays($periodEnd)))
            ->map(fn ($d) => $periodStart->clone()->addDays($d))
            ->toArray();

        $this->totalDays = count($this->days);

        // Llamadas abstractas implementadas en subclases
        $records = $this->fetchRecords($periodStart, $periodEnd);
        $this->buildBars($records, $periodStart, $periodEnd);
    }

    /**
     * Método abstracto: las subclases definen cómo obtener los registros base.
     */
    abstract protected function fetchRecords(Carbon $periodStart, Carbon $periodEnd): Collection|array;

    /**
     * Método abstracto: procesa los registros y construye las barras.
     */
    abstract protected function buildBars(Collection|array $records, Carbon $periodStart, Carbon $periodEnd): void;

    /**
     * Devuelve una etiqueta del mes actual (e.g. “Noviembre 2025”)
     */
    public function getMonthLabelProperty(): string
    {
        return Carbon::create($this->year, $this->month, 1)->translatedFormat('F Y');
    }

    /**
     * Render por defecto: sobrescribible por las subclases.
     */
    public function render()
    {
        return view('livewire.base.gantt-base', [
            'days' => $this->days,
            'entities' => $this->entities ?? collect(),
            'barsByEntity' => $this->barsByEntity ?? [],
            'monthLabel' => $this->monthLabel,
            'totalDays' => $this->totalDays,
        ]);
    }
}