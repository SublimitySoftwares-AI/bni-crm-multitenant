<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\ServiceProvider;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\MultitenancyServiceProvider;

class MultitenancyServiceProvider extends ServiceProvider
{
    use UsesTenantModel;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the MultitenancyServiceProvider
        $this->app->register(MultitenancyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set the tenant model class
        $this->app->singleton(
            \Spatie\Multitenancy\Models\Concerns\UsesTenantModel::tenantModelClassKey(),
            fn () => Tenant::class
        );
    }
}