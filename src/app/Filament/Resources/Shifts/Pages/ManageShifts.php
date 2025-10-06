<?php

namespace App\Filament\Resources\Shifts\Pages;

use App\Filament\Resources\Shifts\ShiftResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageShifts extends ManageRecords
{
    protected static string $resource = ShiftResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
