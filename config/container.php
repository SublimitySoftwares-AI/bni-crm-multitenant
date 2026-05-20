<?php

/*
|--------------------------------------------------------------------------
| Container Colors Configuration
|--------------------------------------------------------------------------
|
| These values configure the container colors as they are defined in the
| container-color() and containerText() functions. You may change these
| as necessary to match the container colors you use throughout your
| application.
|
*/
return [
    'colors' => [
        'danger' => [
            'bg' => '#fca5a5',
            'text' => '#7f1d1d',
        ],
        'dark' => [
            'bg' => '#6b7280',
            'text' => '#ffffff',
        ],
        'failure' => [
            'bg' => '#fca5a5',
            'text' => '#7f1d1d',
        ],
        'info' => [
            'bg' => '#93c5fd',
            'text' => '#1e3a5f',
        ],
        'primary' => [
            'bg' => '#60a5fa',
            'text' => '#1e3a5f',
        ],
        'success' => [
            'bg' => '#86efac',
            'text' => '#14532d',
        ],
        'warning' => [
            'bg' => '#fde68a',
            'text' => '#713f12',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Container Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of the container used by the application. You may
    | change this as necessary. The container name is used to determine the
    | name of the scheduled job that clears any containers created by the
    | application. This value may also be used to find the container name
    | when you wish to do things like run commands on a specific container.
    |
    */
    'name' => env('CONTAINER_NAME', 'laravel'),
];