<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Models\Ficha;
use App\Models\FichaCompetencyExecution;
use App\Models\Instructor;

use App\Observers\InstructorObserver;
use App\Observers\FichaCompetencyExecutionObserver;
use App\Observers\FichaObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Ficha::observe(FichaObserver::class);
        Instructor::observe(InstructorObserver::class);
        FichaCompetencyExecution::observe(FichaCompetencyExecutionObserver::class);
    }
}
