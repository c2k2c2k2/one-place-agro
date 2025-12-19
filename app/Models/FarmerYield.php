<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmerYield extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'yields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'variety_id',
        'quantity',
        'price_per_ton',
        'description',
        'images',
        'status',
        'harvest_date',
        'location',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
            'harvest_date' => 'date',
            'quantity' => 'decimal:2',
            'price_per_ton' => 'decimal:2',
        ];
    }

    /**
     * Get the farmer who owns the yield.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the farmer who owns the yield (alias).
     */
    public function farmer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the crop variety for this yield.
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(CropVariety::class, 'variety_id');
    }

    /**
     * Get the bids for this yield.
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'yield_id');
    }

    /**
     * Scope a query to only include active yields.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include sold yields.
     */
    public function scopeSold($query)
    {
        return $query->where('status', 'sold');
    }

    /**
     * Scope a query to filter by location.
     */
    public function scopeByLocation($query, $location)
    {
        return $query->where('location', 'like', '%'.$location.'%');
    }
}
