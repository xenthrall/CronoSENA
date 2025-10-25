<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        // Solo mostrar el botón "Eliminar" si el usuario tiene permiso
        if (auth()->user()?->can('user.delete')) {
            $actions[] = DeleteAction::make()
                ->label('Eliminar usuario');
        }

        return $actions;
    }

    protected function canDelete(): bool
    {
        return auth()->user()?->can('user.delete');
    }

    protected function canDeleteAny(): bool
    {
        return auth()->user()?->can('user.delete');
    }
}
