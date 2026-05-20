<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use HasFactory, UsesLandlordConnection;

    protected $fillable = [
        'name',
        'domain',
        'database',
        'fqdn',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model and register event listeners.
     */
    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            // Auto-generate database name if not provided
            if (empty($tenant->database)) {
                $tenant->database = 'tenant_' . Str::of($tenant->name)->slug('_')->toString();
            }

            // Auto-generate domain if not provided
            if (empty($tenant->domain)) {
                $tenant->domain = Str::of($tenant->name)->slug()->toString() . '.' . config('app.domain', 'bnicrm.local');
            }
        });
    }
}