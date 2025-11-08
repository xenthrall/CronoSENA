<?php

namespace App\Filament\Resources\FichaInstructorLeaderships\Pages;

use App\Filament\Resources\FichaInstructorLeaderships\FichaInstructorLeadershipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageFichaInstructorLeaderships extends ManageRecords
{
    protected static string $resource = FichaInstructorLeadershipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
