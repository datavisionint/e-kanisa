<?php

namespace App\Providers\Filament;

use CodeWithDennis\FilamentThemeInspector\FilamentThemeInspectorPlugin;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use Filament\Forms\Components\Select;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->bootUsing(function () {
                Select::configureUsing(function (Select $select): void {
                    $select
                    ->native(false)
                    ->searchable()
                    ->preload();
                });

                FilamentView::registerRenderHook(
                    PanelsRenderHook::SIDEBAR_FOOTER,
                    fn (): string => Blade::render('<p class=\'copyright\'> @copyright '.today()->year. ' ' . config('app.name'). '</p>'),
                );
            })
            ->registration()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->brandLogo(asset('img/logo.png'))
            ->brandLogoHeight("50px")
            ->darkMode(false)
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
            ->viteTheme('resources/css/filament/app/theme.css')
            ->authMiddleware([
                Authenticate::class,
            ])
            ->font("Nunito Sans")
            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->emptyPanelBackgroundImageUrl(asset('img/auth-bg.jpg'))
                    ->emptyPanelBackgroundImageOpacity('80%')
                    ->showEmptyPanelOnMobile(false),
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled()
                    ->users([
                        "Admin" => "test@email.com"
                    ]),
                FilamentThemeInspectorPlugin::make()
                    ->disabled(fn() => ! app()->hasDebugModeEnabled()),
                // ->disabled(true),
                FilamentEditProfilePlugin::make()
                    ->shouldRegisterNavigation(false)
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')
            ])
            ->spa()
            ->databaseNotifications()
            ->colors([
                "primary" => "#0000ff"
            ]);
    }
}
