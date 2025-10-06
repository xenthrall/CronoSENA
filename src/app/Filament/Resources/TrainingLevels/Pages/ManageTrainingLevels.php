<?php

namespace App\Filament\Resources\TrainingLevels\Pages;

use App\Filament\Resources\TrainingLevels\TrainingLevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTrainingLevels extends ManageRecords
{
    protected static string $resource = TrainingLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
