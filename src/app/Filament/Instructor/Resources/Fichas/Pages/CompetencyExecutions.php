<?php

namespace App\Filament\Instructor\Resources\Fichas\Pages;

use App\Filament\Instructor\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Page;
use App\Models\Ficha;
use App\Models\FichaCompetency;
use Illuminate\Support\Facades\Auth;

class CompetencyExecutions extends Page
{
    protected static string $resource = FichaResource::class;

    protected static ?string $title = 'Desarrollo de la Competencia';

    protected string $view = 'filament.resources.fichas.pages.competency-executions';

    public Ficha $ficha;
    public FichaCompetency $fichaCompetency;

    public function mount($ficha, $ficha_competency): void
    {
        $this->ficha = Ficha::findOrFail($ficha->id);
        $this->fichaCompetency = FichaCompetency::findOrFail($ficha_competency);
        $this->authorizeAccess();
    }

    protected function authorizeAccess(): void
    {
        // Obtener el instructor autenticado
        $instructor = Auth::user();

        // Verificar liderazgo vigente en esta ficha
        $isLeader = $this->ficha->instructorLeaderships()
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
