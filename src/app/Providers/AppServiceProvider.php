<?php

namespace App\Providers;
use App\Observers\FichaObserver;
use App\Models\Ficha;

use Illuminate\Support\ServiceProvider;

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
    }
}
