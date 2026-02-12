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
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use DutchCodingCompany\FilamentSocialite\Provider;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login()
            ->registration()
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->spa(true)
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->databaseTransactions(true)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                FilamentSocialitePlugin::make()
                    // (required) Add providers corresponding with providers in `config/services.php`.
                    ->providers([
                        Provider::make('google')
                            ->label('Google')
                            ->icon('fab-google')
                            ->color(Color::hex('#2f2a6b'))
                            ->outlined(false)
                            ->stateless(false)
                            ->scopes([
                                'openid',
                                'profile',
                                'email',
                                'https://www.googleapis.com/auth/user.phonenumbers.read',
                                'https://www.googleapis.com/auth/user.birthday.read',
                                'https://www.googleapis.com/auth/user.gender.read',
                                'https://www.googleapis.com/auth/user.addresses.read'
                            ])
                            ->with([
                                'access_type' => 'offline',
                                'prompt' => 'consent',
                                'include_granted_scopes' => 'true'
                            ]),
                        Provider::make('facebook')
                            ->label('Facebook')
                            ->icon('fab-facebook')
                            ->color(Color::hex('#1877F2'))
                            ->outlined(false)
                            ->stateless(false)
                            ->scopes([
                                'public_profile',
                                'email',
                                'user_birthday',
                                'user_gender',
                                'user_location',
                            ])
                            ->with([
                                'fields' => 'id,name,email,picture.type(large),first_name,last_name,birthday,gender,location'
                            ]),
                    ])
                    // (optional) Override the panel slug to be used in the oauth routes. Defaults to the panel's configured path.
                    // ->slug('admin')
                    // (optional) Enable/disable registration of new (socialite-) users.
                    ->registration(true)
                // (optional) Enable/disable registration of new (socialite-) users using a callback.
                // In this example, a login flow can only continue if there exists a user (Authenticatable) already.
                // ->registration(fn(string $provider, SocialiteUserContract $oauthUser, ?Authenticatable $user) => (bool) $user)
                // (optional) Change the associated model class.
                // ->userModelClass(\App\Models\User::class)
                // (optional) Change the associated socialite class (see below).
                // ->socialiteUserModelClass(\App\Models\SocialiteUser::class)
            )
            ->renderHook('panels::body.end', function (): string {
                if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))) {
                    return Blade::render("@vite('resources/js/app.js')");
                }
                return '';
            });
    }
}
