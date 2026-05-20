<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tenant Model
    |--------------------------------------------------------------------------
    |
    | This value is the fully qualified class name of the tenant model.
    |
    */
    'tenant_model' => App\Models\Tenant::class,

    /*
    |--------------------------------------------------------------------------
    | Landlord Database Connection
    |--------------------------------------------------------------------------
    |
    | The database connection to use for landlord data (tenants table, etc.).
    |
    */
    'landlord_database_connection' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Tenant Database Connection
    |--------------------------------------------------------------------------
    |
    | The database connection to use for tenant-specific data.
    |
    */
    'tenant_database_connection' => env('DB_TENANT_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Tenant Database Connection Name
    |--------------------------------------------------------------------------
    */
    'tenant_database_connection_name' => env('TENANTABLE_CONNECTION_NAME', 'tenant'),

    /*
    |--------------------------------------------------------------------------
    | Queue Tenant Connection
    |--------------------------------------------------------------------------
    |
    | Whether to use a separate queue connection per tenant.
    |
    */
    'queue_tenant_connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Ignore Routes
    |--------------------------------------------------------------------------
    |
    | Routes that should not be tenant-aware (e.g., superadmin routes).
    |
    */
    'ignored_routes' => [
        'superadmin/*',
        'api/superadmin/*',
    ],

    /*
    |--------------------------------------------------------------------------
    | Tenant-aware Models
    |--------------------------------------------------------------------------
    |
    | Models that should be automatically scoped to the current tenant.
    |
    */
    'tenant_models' => [
        App\Models\Tenant::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Fallback Tenant
    |--------------------------------------------------------------------------
    |
    | The tenant to use when no tenant is found.
    |
    */
    'fallback_tenant' => null,
];