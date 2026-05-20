<?php

use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\Tenant\DashboardController as TenantDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::view('/', 'welcome');

// Authentication routes (handled by Fortify)
require __DIR__ . '/auth.php';

// Superadmin routes
Route::middleware(['auth', 'verified', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::resource('/tenants', \App\Http\Controllers\Superadmin\TenantController::class);
    Route::get('/tenants/{tenant}/approve', [\App\Http\Controllers\Superadmin\TenantController::class, 'approve'])->name('tenants.approve');
    Route::get('/tenants/{tenant}/suspend', [\App\Http\Controllers\Superadmin\TenantController::class, 'suspend'])->name('tenants.suspend');
    Route::get('/tenants/{tenant}/activate', [\App\Http\Controllers\Superadmin\TenantController::class, 'activate'])->name('tenants.activate');
});

// Tenant routes (tenant-aware)
Route::middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('tenant.dashboard');
    Route::get('/leads', [\App\Http\Controllers\Tenant\LeadController::class, 'index'])->name('tenant.leads.index');
    Route::get('/leads/create', [\App\Http\Controllers\Tenant\LeadController::class, 'create'])->name('tenant.leads.create');
    Route::post('/leads', [\App\Http\Controllers\Tenant\LeadController::class, 'store'])->name('tenant.leads.store');
    Route::get('/leads/{lead}', [\App\Http\Controllers\Tenant\LeadController::class, 'show'])->name('tenant.leads.show');
    Route::get('/leads/{lead}/edit', [\App\Http\Controllers\Tenant\LeadController::class, 'edit'])->name('tenant.leads.edit');
    Route::put('/leads/{lead}', [\App\Http\Controllers\Tenant\LeadController::class, 'update'])->name('tenant.leads.update');
    Route::delete('/leads/{lead}', [\App\Http\Controllers\Tenant\LeadController::class, 'destroy'])->name('tenant.leads.destroy');
    Route::get('/exhibitions', [\App\Http\Controllers\Tenant\ExhibitionController::class, 'index'])->name('tenant.exhibitions.index');
    Route::get('/exhibitions/create', [\App\Http\Controllers\Tenant\ExhibitionController::class, 'create'])->name('tenant.exhibitions.create');
    Route::post('/exhibitions', [\App\Http\Controllers\Tenant\ExhibitionController::class, 'store'])->name('tenant.exhibitions.store');
    Route::get('/exhibitions/{exhibition}', [\App\Http\Controllers\Tenant\ExhibitionController::class, 'show'])->name('tenant.exhibitions.show');
});

// Fallback dashboard redirect
Route::get('/dashboard', function () {
    if (auth()->user()?->hasRole('superadmin')) {
        return redirect()->route('superadmin.dashboard');
    }
    return redirect()->route('tenant.dashboard');
})->name('dashboard');