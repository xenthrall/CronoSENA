<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFicha extends EditRecord
{
    protected static string $resource = FichaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
