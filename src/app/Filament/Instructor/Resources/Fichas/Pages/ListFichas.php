<?php

namespace App\Filament\Instructor\Resources\Fichas\Pages;

use App\Filament\Instructor\Resources\Fichas\FichaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFichas extends ListRecords
{
    protected static string $resource = FichaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
