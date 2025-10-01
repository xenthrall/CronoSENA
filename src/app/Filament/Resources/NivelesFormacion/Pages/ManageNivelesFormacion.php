<?php

namespace App\Filament\Resources\NivelesFormacion\Pages;

use App\Filament\Resources\NivelesFormacion\NivelFormacionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageNivelesFormacion extends ManageRecords
{
    protected static string $resource = NivelFormacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
