<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'variety_id',
        'quantity_required',
        'max_budget',
        'location',
        'description',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity_required' => 'decimal:2',
            'max_budget' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the trader who posted the requirement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the trader who posted the requirement (alias).
     */
    public function trader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the crop variety for this requirement.
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(CropVariety::class, 'variety_id');
    }

    /**
     * Scope a query to only include active requirements.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', '%'.$location.'%');
    }
}
