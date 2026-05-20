<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExhibitionAttendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhibition_id',
        'lead_id',
        'name',
        'email',
        'phone',
        'company',
        'checked_in',
        'checked_in_at',
        'checked_in_by',
    ];

    protected $casts = [
        'checked_in' => 'boolean',
        'checked_in_at' => 'datetime',
    ];

    /**
     * Get the exhibition this attendee belongs to.
     */
    public function exhibition(): BelongsTo
    {
        return $this->belongsTo(Exhibition::class);
    }

    /**
     * Get the lead associated with this attendee (if any).
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Mark attendee as checked in.
     */
    public function checkIn(string $checkedInBy): void
    {
        $this->update([
            'checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => $checkedInBy,
        ]);
    }
}