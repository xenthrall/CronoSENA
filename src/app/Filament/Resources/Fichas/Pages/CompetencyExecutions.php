<?php

namespace App\Filament\Resources\Fichas\Pages;

use App\Filament\Resources\Fichas\FichaResource;
use Filament\Resources\Pages\Page;
use App\Models\Ficha;
use App\Models\FichaCompetency;

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
    }
}
