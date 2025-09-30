<?php

namespace App\Filament\Resources\Competencias\Pages;

use App\Filament\Resources\Competencias\CompetenciaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompetencias extends ListRecords
{
    protected static string $resource = CompetenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
