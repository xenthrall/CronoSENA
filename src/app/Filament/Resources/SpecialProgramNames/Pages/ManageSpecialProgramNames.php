<?php

namespace App\Filament\Resources\SpecialProgramNames\Pages;

use App\Filament\Resources\SpecialProgramNames\SpecialProgramNameResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSpecialProgramNames extends ManageRecords
{
    protected static string $resource = SpecialProgramNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
