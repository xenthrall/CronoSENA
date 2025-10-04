<?php

namespace App\Filament\Resources\Jornadas\Pages;

use App\Filament\Resources\Jornadas\JornadaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageJornadas extends ManageRecords
{
    protected static string $resource = JornadaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
