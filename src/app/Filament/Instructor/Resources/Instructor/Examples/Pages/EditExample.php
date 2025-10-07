<?php

namespace App\Filament\Instructor\Resources\Instructor\Examples\Pages;

use App\Filament\Instructor\Resources\Instructor\Examples\ExampleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExample extends EditRecord
{
    protected static string $resource = ExampleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
