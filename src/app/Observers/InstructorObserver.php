<?php

namespace App\Observers;

use App\Models\Instructor;

class InstructorObserver
{
    /**
     * Handle the Instructor "created" event.
     */
    public function created(Instructor $instructor): void
    {
        //
    }

    /**
     * Handle the Instructor "updated" event.
     */
    public function updated(Instructor $instructor): void
    {
        //
    }

    /**
     * Handle the Instructor "deleted" event.
     */
    public function deleted(Instructor $instructor): void
    {
        //
    }

    /**
     * Handle the Instructor "restored" event.
     */
    public function restored(Instructor $instructor): void
    {
        //
    }

    /**
     * Handle the Instructor "force deleted" event.
     */
    public function forceDeleted(Instructor $instructor): void
    {
        //
    }
}
