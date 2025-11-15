<?php

namespace App\Traits\Gantt;

/**
 * Trait que agrega configuración fluida para los componentes Gantt.
 *
 * Permite definir propiedades básicas del diagrama con una API encadenable,
 * similar a cómo lo hace Filament (->label(), ->icon(), etc.)
 */
trait HasGanttConfiguration
{
    public string $entityName = 'Entidad';

    public int $dayWidthPx = 40;
    public int $rowHeightPx = 54;

    public function configure(): static
    {
        return $this;
    }

    // --- Fluent API ---

    public function entityName(string $name): static
    {
        $this->entityName = $name;
        return $this;
    }

    public function columnsWidth(int $width): static
    {
        $this->columnWidthPx = $width;
        return $this;
    }

    public function rowHeight(int $height): static
    {
        $this->rowHeightPx = $height;
        return $this;
    }
    
    public function period(int $month, int $year): static
    {
        $this->month = $month;
        $this->year = $year;
        return $this;
    }
}
