<?php

namespace App\Providers;
use App\Observers\FichaObserver;
use App\Models\Ficha;
use App\Models\Instructor;
use Illuminate\Support\ServiceProvider;
use App\Observers\InstructorObserver;

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
    }
}
