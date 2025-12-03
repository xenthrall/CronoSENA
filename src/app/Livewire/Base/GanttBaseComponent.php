<?php

namespace App\Livewire\Base;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

use App\Traits\Gantt\HasGanttConfiguration;
use App\Traits\Gantt\GanttBarsTrait;

abstract class GanttBaseComponent extends Component
{
    use GanttBarsTrait;
    use HasGanttConfiguration;
    
    public int $month;
    public int $year;

    public string $monthLabel;

    public int $columnWidthPx = 40;
    public int $rowHeightPx = 54;

    public int $totalColumns = 0;

    public array $columns = [];

    public array $rows = [];
    public array $barsByRow = [];
    

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

        $this->columns = collect(range(0, $periodStart->diffInDays($periodEnd)))
            ->map(fn ($d) => $periodStart->clone()->addDays($d))
            ->toArray();

        $this->totalColumns = count($this->columns);

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



    public function render()
    {
        return view('livewire.base.gantt-base');
    }
}