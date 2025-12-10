<?php

namespace App\Filament\Instructor\Resources\Fichas\Pages;

use App\Filament\Instructor\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\Action;

class ManageFicha extends Page
{
    use InteractsWithRecord;

    protected static string $resource = FichaResource::class;

    protected string $view = 'filament.resources.fichas.pages.manage-ficha';

    protected static ?string $title = 'Gestionar ficha';

    //protected static ?string $breadcrumb = 'Gestionar ficha';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->authorizeAccess();
    }

    protected function authorizeAccess(): void
    {
        // Obtener el instructor autenticado
        $instructor = Auth::user();

        // Verificar liderazgo vigente en esta ficha
        $isLeader = $this->record->instructorLeaderships()
            ->where('instructor_id', $instructor->id)
            ->whereNull('end_date')   // Vigente
            ->exists();

        abort_unless(
            $isLeader,
            403,
            'Solo el instructor líder vigente puede gestionar esta ficha.'
        );
    }
    
}
