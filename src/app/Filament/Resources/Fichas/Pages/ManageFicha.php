<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ManageFicha extends Page
{
    use InteractsWithRecord;

    protected static string $resource = FichaResource::class;

    protected string $view = 'filament.resources.fichas.pages.manage-ficha';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }
}
