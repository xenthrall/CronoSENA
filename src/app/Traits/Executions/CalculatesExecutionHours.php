<?php

namespace App\Traits\Executions;

use Carbon\Carbon;

trait CalculatesExecutionHours
{
    /**
     * Calcula el total de horas laborales entre dos fechas,
     * considerando únicamente días hábiles (lunes a viernes).
     */
    public static function calculateWorkHoursBetweenDates($startDate, $endDate)
    {
        if (!$startDate || !$endDate) {
            return null;
        }

        $start = Carbon::parse($startDate);
        $end   = Carbon::parse($endDate);

        if ($end->lessThan($start)) {
            return null;
        }

        $businessDays = self::countBusinessDays($start, $end);
        $dailyHours   = 8;

        return $businessDays * $dailyHours;
    }

    /**
     * Cuenta cuántos días hábiles existen entre dos fechas.
     */
    private static function countBusinessDays(Carbon $start, Carbon $end)
    {
        $days = 0;
        $current = $start->copy();

        while ($current->lte($end)) {
            if ($current->isWeekday()) {
                $days++;
            }
            $current->addDay();
        }

        return $days;
    }

    /**
     * Calcula la cantidad máxima de horas ejecutables según las semanas
     * que cubre el rango de fechas y las horas restantes disponibles.
     * Cada semana permite hasta 48 horas.
     */
    public static function calculateMaxExecutableHours($startDate, $endDate, $remainingHours)
    {
        if (!$startDate || !$endDate) {
            return 0;
        }

        $start = Carbon::parse($startDate);
        $end   = Carbon::parse($endDate);

        if ($end->lessThan($start)) {
            return 0;
        }

        $weeksInRange = self::countDistinctIsoWeeks($start, $end);
        $maxHoursByWeeks = $weeksInRange * 48;

        return min($maxHoursByWeeks, $remainingHours);
    }

    /**
     * Cuenta las semanas ISO distintas cubiertas por un rango de fechas.
     */
    private static function countDistinctIsoWeeks(Carbon $start, Carbon $end)
    {
        $weeks = [];
        $current = $start->copy();

        while ($current->lte($end)) {
            $weekKey = $current->year . '-W' . $current->isoWeek();
            $weeks[$weekKey] = true;
            $current->addDay();
        }

        return count($weeks);
    }
}
