<?php

namespace App\Filament\Resources\EquipoEjecutors\Pages;

use App\Filament\Resources\EquipoEjecutors\EquipoEjecutorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageEquipoEjecutors extends ManageRecords
{
    protected static string $resource = EquipoEjecutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
