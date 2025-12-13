<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Page;

class CronogramasDashboard extends Page
{
    protected string $view = 'filament.pages.dashboards.cronogramas-dashboard';

    protected static ?string $title = '';

    protected static string|\UnitEnum|null $navigationGroup = 'programación';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'progreso';

    protected static ?string $slug = 'dashboard-cronogramas';


}
