<?php

namespace App\Filament\Resources\Municipalities\Pages;

use App\Filament\Resources\Municipalities\MunicipalityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMunicipalities extends ManageRecords
{
    protected static string $resource = MunicipalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
