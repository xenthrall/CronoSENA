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
            ->groupBy('model');

        $sections = [];

        foreach ($permissions as $model => $perms) {
            $sections[] = Section::make($model)
                ->collapsed(false)
                ->schema([
                    CheckboxList::make("permissions.{$model}")
                        ->options($perms->pluck('name', 'id'))
                        ->columns(2)
                        ->searchable()
                        ->bulkToggleable()
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
                    ->view('components.toggle-all'),

                ...$sections, // ← Aquí renderizamos todas las secciones dinámicas
            ]);
    }

}
