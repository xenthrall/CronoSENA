<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PlanificacionAcademicaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('planificacion')
            ->path('planificacion')
            ->login()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->brandName('Planificación Académica')
            ->brandLogo(asset('images/logo-cata.png'))
            ->darkModeBrandLogo(asset('images/logo-cata-dark.png'))
            ->brandLogoHeight('2.5rem')
            ->discoverResources(in: app_path('Filament/PlanificacionAcademica/Resources'), for: 'App\Filament\PlanificacionAcademica\Resources')
            ->discoverPages(in: app_path('Filament/PlanificacionAcademica/Pages'), for: 'App\Filament\PlanificacionAcademica\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/PlanificacionAcademica/Widgets'), for: 'App\Filament\PlanificacionAcademica\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
