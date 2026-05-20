<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Exhibition extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $fillable = [
        'name',
        'description',
        'location',
        'start_date',
        'end_date',
        'max_attendees',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the attendees for this exhibition.
     */
    public function attendees(): HasMany
    {
        return $this->hasMany(ExhibitionAttendee::class);
    }

    /**
     * Get the user who created this exhibition.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Check if exhibition is currently active.
     */
    public function isActive(): bool
    {
        return $this->status === 'ongoing';
    }

    /**
     * Check if exhibition is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->start_date->isFuture() && $this->status === 'published';
    }

    /**
     * Scope for published exhibitions.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for upcoming exhibitions.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now())->where('status', 'published');
    }
}