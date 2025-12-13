<?php

namespace App\Filament\Actions\programacion\instructors;

use Filament\Actions\Action;
use Filament\Support\Enums\Alignment;
use Filament\Infolists\Components\TextEntry;

class ShowExecutionTestAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'showExecutionTest')
            ->label('Detalle ejecución')
            ->modalHeading('Detalle de la ejecución')
            ->modalAlignment(Alignment::Center)
            ->modalSubmitAction(false) // sin botón guardar
            ->modalCancelActionLabel('Cerrar')
            ->schema([
                TextEntry::make('test')
                    ->label('Mensaje')
                    ->default('Hola'),
            ]);
    }
}
