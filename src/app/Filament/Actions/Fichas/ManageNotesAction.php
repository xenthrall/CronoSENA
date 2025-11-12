<?php

namespace App\Filament\Actions\Fichas;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Support\Enums\Alignment;
use Filament\Schemas\Components\Grid;
use Filament\Notifications\Notification;

class ManageNotesAction extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'manageNotes')
            ->label('Ver / Editar Observaciones')
            ->icon('heroicon-o-exclamation-circle')
            ->color('primary')
            ->modalHeading(fn($record) => $record->competency->name)
            ->modalIcon('heroicon-o-clipboard-document-list')
            ->modalSubmitAction(
                fn($action) => $action
                    ->label('Guardar cambios')
                    ->icon('heroicon-o-check-circle')
                    ->color('info')
                    ->iconButton()
                    ->size('lg')
            )
            ->modalAlignment(Alignment::Center)
            ->schema([
                Grid::make(1)
                    ->schema([
                        Textarea::make('notes')
                            ->label('Observaciones')
                            ->placeholder('Agrega aquí las observaciones sobre la competencia...')
                            ->rows(6)
                            ->default(fn($record) => $record->notes)
                            ->maxLength(1000)
                            ->required(fn($record) => filled($record->notes)),
                    ]),
            ])
            ->action(function (array $data, $record) {
                $record->update([
                    'notes' => $data['notes'] ?? null,
                ]);

                Notification::make()
                    ->title('Observaciones actualizadas correctamente')
                    ->success()
                    ->send();
            })
            ->extraModalFooterActions([
                Action::make('clearNotes')
                    ->label('Limpiar observaciones')
                    ->color(fn($record) => filled($record->notes) ? 'danger' : 'gray')
                    ->icon('heroicon-o-trash')
                    ->iconButton()
                    ->requiresConfirmation()
                    ->cancelParentActions()
                    ->size('lg')
                    ->disabled(fn($record) => !filled($record->notes))
                    ->modalHeading('¿Limpiar observaciones?')
                    ->modalDescription('Esto eliminará todas las observaciones actuales. Esta acción no se puede deshacer.')
                    ->action(function ($record) {
                        $record->update(['notes' => null]);

                        Notification::make()
                            ->title('Observaciones eliminadas correctamente')
                            ->success()
                            ->send();
                    }),
            ]);
    }
}
