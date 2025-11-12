<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFicha extends CreateRecord
{
    protected static string $resource = FichaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('manage', ['record' => $this->record]);
    }
}
