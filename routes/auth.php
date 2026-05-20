<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// All standard auth routes (login, register, password reset, etc.)
// are auto-registered by Laravel Fortify.
// Only custom logout needs to be here:
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');