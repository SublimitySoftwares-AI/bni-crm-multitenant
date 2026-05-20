<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Lead extends Model
{
    use HasFactory, UsesTenantConnection;

    // Status constants
    public const STATUS_NEW = 'new';
    public const STATUS_CONTACTED = 'contacted';
    public const STATUS_QUALIFIED = 'qualified';
    public const STATUS_WON = 'won';
    public const STATUS_LOST = 'lost';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'designation',
        'source',
        'notes',
        'status',
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
     * Get all statuses with labels.
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_CONTACTED => 'Contacted',
            self::STATUS_QUALIFIED => 'Qualified',
            self::STATUS_WON => 'Won',
            self::STATUS_LOST => 'Lost',
        ];
    }

    /**
     * Get status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_NEW => 'blue',
            self::STATUS_CONTACTED => 'yellow',
            self::STATUS_QUALIFIED => 'green',
            self::STATUS_WON => 'emerald',
            self::STATUS_LOST => 'red',
            default => 'gray',
        };
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