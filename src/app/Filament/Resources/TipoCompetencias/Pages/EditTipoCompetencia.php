<?php

namespace App\Filament\Resources\TipoCompetencias\Pages;

use App\Filament\Resources\TipoCompetencias\TipoCompetenciaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTipoCompetencia extends EditRecord
{
    protected static string $resource = TipoCompetenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
