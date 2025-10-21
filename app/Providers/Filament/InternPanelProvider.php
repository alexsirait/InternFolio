<?php

namespace App\Providers\Filament;

use App\Http\Middleware\CheckInternRating;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Enums\Width;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Pages\Enums\SubNavigationPosition;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class InternPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->spa()
            ->id('intern')
            ->path('intern')
            ->login()
            // ->profile()
            // ->passwordReset()
            ->resourceCreatePageRedirect('index')
            ->resourceEditPageRedirect('index')
            ->colors([
                'primary' => Color::Sky,
            ])
            ->font('Poppins', provider: GoogleFontProvider::class)
            ->brandName('InternFolio')
            ->brandLogo(asset('image/logo.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('image/logo.png'))
            ->maxContentWidth(Width::Full)
            ->simplePageMaxContentWidth(Width::Small)
            ->unsavedChangesAlerts()
            ->topNavigation()
            ->discoverResources(in: app_path('Filament/Intern/Resources'), for: 'App\Filament\Intern\Resources')
            ->discoverPages(in: app_path('Filament/Intern/Pages'), for: 'App\Filament\Intern\Pages')
            ->pages([
                // Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Intern/Widgets'), for: 'App\Filament\Intern\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
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
                CheckInternRating::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
