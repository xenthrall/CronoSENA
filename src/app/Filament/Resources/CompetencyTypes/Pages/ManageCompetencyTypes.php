<?php

namespace App\Filament\Resources\CompetencyTypes\Pages;

use App\Filament\Resources\CompetencyTypes\CompetencyTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCompetencyTypes extends ManageRecords
{
    protected static string $resource = CompetencyTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
