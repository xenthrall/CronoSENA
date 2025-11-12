<?php

namespace App\Filament\Actions\InstructorLeader;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Enums\Alignment;





class EditEndDate extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'editEndDate')
            ->label('Fecha de Finalización')
            ->icon('heroicon-o-pencil')
            ->color('primary')
            ->modalHeading(fn($record) => "Editar fecha de finalizacion para: " . $record->instructor->full_name)
            ->modalIcon('heroicon-o-pencil')
            ->modalSubmitActionLabel('Guardar cambios')
            ->schema([
                DatePicker::make('end_date')
                            ->label('Fecha de finalización')
                            ->required()
                            ->default(fn($record) => $record->end_date),
            ])
            ->modalAlignment(Alignment::Center)
            ->action(function (array $data, $record) {
                $record->update([
                    'end_date' => $data['end_date'],
                ]);
                    
            })
            ->successNotificationTitle('Fecha de finalización actualizada con éxito.');
    }
}
