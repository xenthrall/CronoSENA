<?php

namespace App\Traits\Gantt;

use Carbon\Carbon;

trait GanttBarsTrait
{

    protected function normalizeDates(mixed $start, mixed $end): array
    {
        $start = $start instanceof Carbon ? $start->copy()->startOfDay() : Carbon::parse($start)->startOfDay();
        $end = $end
            ? ($end instanceof Carbon ? $end->copy()->endOfDay() : Carbon::parse($end)->endOfDay())
            : $start->copy()->endOfDay();

        return [$start, $end];
    }

    protected function clampToPeriod(Carbon $start, Carbon $end, Carbon $periodStart, Carbon $periodEnd): ?array
    {
        $visibleStart = $start->max($periodStart);
        $visibleEnd = $end->min($periodEnd);

        if ($visibleEnd->lt($visibleStart)) {
            return null;
        }

        return [$visibleStart, $visibleEnd];
    }

    protected function calculateOffsetAndDuration(Carbon $visibleStart, Carbon $visibleEnd, Carbon $periodStart): array
    {
        $offset = $periodStart->diffInDays($visibleStart);
        $duration = $visibleStart->diffInDays($visibleEnd) + 1;

        return [$offset, $duration];
    }

    protected function toPercentage(int $value, int $totalColumns): float
    {
        return ($value / $totalColumns) * 100;
    }

    /**
     * Construye una barra (LEFT, WIDTH + METADATA).
     */
    protected function makeGanttBar(array $meta, Carbon $execStart, Carbon $execEnd, Carbon $periodStart, Carbon $periodEnd, int $totalColumns): ?array
    {
        // 1. Normalizar
        [$start, $end] = $this->normalizeDates($execStart, $execEnd);

        // 2. Recortar al período visible
        $clamped = $this->clampToPeriod($start, $end, $periodStart, $periodEnd);

        if (!$clamped) {
            return null;
        }

        [$visibleStart, $visibleEnd] = $clamped;

        // 3. Offset y duración
        [$offset, $duration] = $this->calculateOffsetAndDuration($visibleStart, $visibleEnd, $periodStart);
        
        

        // 4. Conversión a porcentaje
        //suma 1 al offset para que la barra inicie en el día correcto con respecto a la columna vacia
        $leftPct = $this->toPercentage($offset+1, $totalColumns);
        $widthPct = $this->toPercentage($duration, $totalColumns);

        // 5. Armar barra final
        return array_merge([
            'left'       => $leftPct,
            'width'      => $widthPct,
            'started_at' => $start->translatedFormat('j M'),
            'ended_at'   => $end->translatedFormat('j M'),
            'tooltip'    => "{$start->format('d/m')} - {$end->format('d/m')}",
        ], $meta);
    }
}
