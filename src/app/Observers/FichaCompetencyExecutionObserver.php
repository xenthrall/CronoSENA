<?php

namespace App\Observers;

use App\Models\FichaCompetencyExecution;

use App\Traits\ManagesFichaCompetencyProgress;

class FichaCompetencyExecutionObserver
{
    use ManagesFichaCompetencyProgress;
    
    public function created(FichaCompetencyExecution $execution): void
    {
        $this->updateExecutedHours($execution->fichaCompetency);
    }

    /**
     * Handle the FichaCompetencyExecution "updated" event.
     */
    public function updated(FichaCompetencyExecution $execution): void
    {
        $this->updateExecutedHours($execution->fichaCompetency);
    }

    /**
     * Handle the FichaCompetencyExecution "deleted" event.
     */
    public function deleted(FichaCompetencyExecution $execution): void
    {   
        $this->updateExecutedHours($execution->fichaCompetency);
    }

    /**
     * Handle the FichaCompetencyExecution "restored" event.
     */
    public function restored(FichaCompetencyExecution $execution): void
    {
        //
    }

    /**
     * Handle the FichaCompetencyExecution "force deleted" event.
     */
    public function forceDeleted(FichaCompetencyExecution $fichaCompetencyExecution): void
    {
        //
    }

    
}
