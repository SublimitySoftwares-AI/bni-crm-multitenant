<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fortify Actions
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'login' => \App\Actions\Fortify\AttemptToAuthenticate::class,
        'confirm' => \App\Actions\Fortify\ConfirmDevice::class,
        'create_user' => \App\Actions\Fortify\CreateNewUser::class,
        'reset_password' => \App\Actions\Fortify\ResetUserPassword::class,
        'update_password' => \App\Actions\Fortify\UpdateUserPassword::class,
        'update_profile' => \App\Actions\Fortify\UpdateUserProfileInformation::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Fortify Features
    |--------------------------------------------------------------------------
    */
    'features' => [
        \Laravel\Fortify\Features::registration(),
        \Laravel\Fortify\Features::resetPasswords(),
        \Laravel\Fortify\Features::emailVerification(),
        // \Laravel\Fortify\Features::updateProfileInformation(),
        // \Laravel\Fortify\Features::updatePasswords(),
        // \Laravel\Fortify\Features::twoFactorAuthentication(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirects
    |--------------------------------------------------------------------------
    */
    'redirects' => [
        'login' => '/dashboard',
        'logout' => '/login',
        'register' => '/dashboard',
        'reset-password' => '/login',
        'verify-email' => '/dashboard',
    ],
];