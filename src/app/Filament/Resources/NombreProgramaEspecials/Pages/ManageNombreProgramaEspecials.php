<?php

namespace App\Filament\Resources\NombreProgramaEspecials\Pages;

use App\Filament\Resources\NombreProgramaEspecials\NombreProgramaEspecialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageNombreProgramaEspecials extends ManageRecords
{
    protected static string $resource = NombreProgramaEspecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
