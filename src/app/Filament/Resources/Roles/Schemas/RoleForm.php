<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {

        // Agrupamos permisos por el campo 'model'
        $permissions = Permission::query()
            ->get()
            ->groupBy('group');

        $sections = [];

        foreach ($permissions as $group => $perms) {
            $sections[] = Section::make($group)
                ->collapsed(false)
                ->schema([
                    CheckboxList::make("permissions.{$group}")
                        ->options($perms->pluck('action', 'id'))
                        ->columns(2)
                        ->searchable()
                        ->bulkToggleable()
                        ->descriptions($perms->pluck('description', 'id'))
                        ->label(false),
                ]);
        }

        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Rol')
                    ->required(),

                ViewField::make('checkall')
                    ->label('Seleccionar / Deseleccionar todos')
                    ->view('filament.components.toggle-all'),

                ...$sections, // ← Aquí renderizamos todas las secciones dinámicas
            ]);
    }

}
