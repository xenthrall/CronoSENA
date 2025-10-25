<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Tables\RolesTable;
use App\Models\Role;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|\UnitEnum|null $navigationGroup = 'sistema';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Roles y Permisos';

    protected static ?string $modelLabel = 'Rol';

    protected static ?string $pluralModelLabel = 'Roles';

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | 🔒 Control de Acceso con Spatie Permissions
    |--------------------------------------------------------------------------
    */
    public static function canViewAny(): bool
    {
        return Auth::user()?->can('role.view');
    }

    public static function canView($record): bool
    {
        return Auth::user()?->can('role.view');
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->can('role.create');
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->can('role.edit');
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->can('role.delete');
    }

    public static function canDeleteAny(): bool
    {
        return Auth::user()?->can('role.delete');
    }
}
