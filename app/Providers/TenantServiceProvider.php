<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Spatie\Multitenancy\MultitenancyServiceProvider::class);

        // Register Fortify
        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::registerView(function () {
            return view('auth.register');
        });
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(\Spatie\Multitenancy\Contracts\IsTenant::class, Tenant::class);
    }
}