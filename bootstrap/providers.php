<?php

use App\Providers\AppServiceProvider;
use App\Providers\TenantServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    TenantServiceProvider::class,
    FortifyServiceProvider::class,
];