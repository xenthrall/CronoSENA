<?php

namespace App\Filament\Resources\ExecutingTeams\Pages;

use App\Filament\Resources\ExecutingTeams\ExecutingTeamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageExecutingTeams extends ManageRecords
{
    protected static string $resource = ExecutingTeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
