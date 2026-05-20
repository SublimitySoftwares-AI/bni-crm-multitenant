<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Lead extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'designation',
        'source',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created this lead.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for filtering by source.
     */
    public function scopeFromSource($query, $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Get display name.
     */
    public function getDisplayNameAttribute()
    {
        return $this->name . ($this->company ? ' - ' . $this->company : '');
    }
}