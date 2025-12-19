<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'yield_id',
        'trader_id',
        'bid_amount',
        'quantity',
        'message',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'bid_amount' => 'decimal:2',
            'quantity' => 'decimal:2',
        ];
    }

    /**
     * Get the yield that this bid is for.
     */
    public function yield(): BelongsTo
    {
        return $this->belongsTo(FarmerYield::class, 'yield_id');
    }

    /**
     * Get the trader who placed the bid.
     */
    public function trader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trader_id');
    }

    /**
     * Scope a query to only include pending bids.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include accepted bids.
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope a query to only include rejected bids.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if the bid is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the bid is accepted.
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    /**
     * Check if the bid is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
