<?php

namespace App\Filament\Resources\TrainingEnvironments\Pages;

use App\Filament\Resources\TrainingEnvironments\TrainingEnvironmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTrainingEnvironments extends ManageRecords
{
    protected static string $resource = TrainingEnvironmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
