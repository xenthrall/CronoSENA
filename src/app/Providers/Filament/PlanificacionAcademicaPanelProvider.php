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
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use App\Filament\Resources\Fichas\FichaResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\PlanificacionAcademica\Pages\Auth\PlanificacionLogin;

class PlanificacionAcademicaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('planificacion')
            ->path('planificacion')
            ->login(PlanificacionLogin::class)
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->brandName('Planificación Académica')
            ->brandLogo(asset('images/logo-cata.png'))
            ->darkModeBrandLogo(asset('images/logo-cata-dark.png'))
            ->brandLogoHeight('2.5rem')
            ->discoverResources(in: app_path('Filament/PlanificacionAcademica/Resources'), for: 'App\Filament\PlanificacionAcademica\Resources')
            ->resources([
                FichaResource::class,
            ])
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
            ])

            ->navigationGroups([
                NavigationGroup::make()
                    ->label('programas')
                    ->icon('heroicon-o-book-open')
                    ->collapsed(), //contraible deshabilitado -> false
                NavigationGroup::make()
                    ->label('fichas')
                    ->icon('heroicon-o-pencil'),
                NavigationGroup::make()
                    ->label('instructores')
                    ->icon('heroicon-o-user-group')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('sistema')
                    ->collapsed(),
            ])

            ->assets([
                Css::make('custom-stylesheet', resource_path('css/custom.css')),
                //Js::make('custom-script', resource_path('js/custom.js')),
            ])
            
            //->topNavigation() //Habilitar la barra de navegación superior

            ->sidebarCollapsibleOnDesktop()
            //->spa() //Habilitar la aplicación de una sola página (SPA)
            ->unsavedChangesAlerts()
            //->sidebarFullyCollapsibleOnDesktop() //Contraer la barra lateral completamente
        ;
    }
}
