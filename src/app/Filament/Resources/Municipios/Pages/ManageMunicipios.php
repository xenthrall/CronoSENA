<?php

namespace App\Filament\Resources\Municipios\Pages;

use App\Filament\Resources\Municipios\MunicipioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMunicipios extends ManageRecords
{
    protected static string $resource = MunicipioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
