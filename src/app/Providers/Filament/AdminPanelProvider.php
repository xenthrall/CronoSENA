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
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use App\Filament\Pages\Auth\AdminLogin;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(AdminLogin::class)
            ->profile(isSimple: false)
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->brandName('admin')
            ->brandLogo(asset('images/logo-cata.png'))
            ->darkModeBrandLogo(asset('images/logo-cata-dark.png'))
            //->brandLogo(fn () => view('filament.admin.logo'))
            //->darkModeBrandLogo(fn () => view('filament.admin.logo-dark'))

            ->brandLogoHeight('2.5rem')


           // ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
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
