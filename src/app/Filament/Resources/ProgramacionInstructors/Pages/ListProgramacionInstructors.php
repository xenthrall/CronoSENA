<?php

namespace App\Filament\Resources\ProgramacionInstructors\Pages;

use App\Filament\Resources\ProgramacionInstructors\ProgramacionInstructorResource;
use Filament\Resources\Pages\ListRecords;

class ListProgramacionInstructors extends ListRecords
{
    protected static string $resource = ProgramacionInstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
