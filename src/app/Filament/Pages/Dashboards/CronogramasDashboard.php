<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Page;

class CronogramasDashboard extends Page
{
    protected string $view = 'filament.pages.dashboards.cronogramas-dashboard';

    protected static ?string $title = '';

    protected static string|\UnitEnum|null $navigationGroup = 'gestion academica';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Cronogramas';

    protected static ?string $slug = 'dashboard-cronogramas';


}
