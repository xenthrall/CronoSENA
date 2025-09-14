<?php

namespace App\Filament\Resources\Competencias\Pages;

use App\Filament\Resources\Competencias\CompetenciaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompetencia extends EditRecord
{
    protected static string $resource = CompetenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
