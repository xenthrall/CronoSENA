<?php

namespace App\Observers;

use App\Models\Instructor;
use App\Services\ImageOptimizer;

class InstructorObserver
{
    /**
     * Handle the Instructor "created" event.
     */
    public function created(Instructor $instructor): void
    {
    
        if ($instructor->photo_url) {
            $optimizer = app(ImageOptimizer::class);
            $optimizedPath = $optimizer->optimize($instructor->photo_url, [
                'max_width' => 150,
                'quality' => 80,
                'delete_old_path' => true,
            ]);
            $instructor->update(['photo_url' => $optimizedPath]); 
        }

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
