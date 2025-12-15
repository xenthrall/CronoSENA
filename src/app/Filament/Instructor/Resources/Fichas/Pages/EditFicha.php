<?php

namespace App\Filament\Instructor\Resources\Fichas\Pages;

use App\Filament\Instructor\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\EditRecord;

class EditFicha extends EditRecord
{
    protected static string $resource = FichaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
