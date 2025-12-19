<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketPrice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'market_name',
        'variety_id',
        'min_price',
        'max_price',
        'modal_price',
        'date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'min_price' => 'decimal:2',
            'max_price' => 'decimal:2',
            'modal_price' => 'decimal:2',
            'date' => 'date',
        ];
    }

    /**
     * Get the crop variety for this market price.
     */
    public function variety(): BelongsTo
    {
        return $this->belongsTo(CropVariety::class, 'variety_id');
    }

    /**
     * Scope a query to filter by market name.
     */
    public function scopeByMarket($query, $marketName)
    {
        return $query->where('market_name', $marketName);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to get recent prices.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('date', '>=', now()->subDays($days));
    }
}
