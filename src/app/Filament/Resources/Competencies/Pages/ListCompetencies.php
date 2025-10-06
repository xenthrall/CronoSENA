<?php

namespace App\Filament\Resources\Competencies\Pages;

use App\Filament\Resources\Competencies\CompetencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompetencies extends ListRecords
{
    protected static string $resource = CompetencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
