<?php

namespace App\Filament\Instructor\Resources\Instructor\Examples\Pages;

use App\Filament\Instructor\Resources\Instructor\Examples\ExampleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExamples extends ListRecords
{
    protected static string $resource = ExampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
