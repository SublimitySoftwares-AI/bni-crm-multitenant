<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\Spatie\Multitenancy\MultitenancyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Bind tenant model
        $this->app->bind(\Spatie\Multitenancy\Contracts\IsTenant::class, Tenant::class);
    }
}