<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CropVariety extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image_url',
    ];

    /**
     * Get the yields for this crop variety.
     */
    public function yields(): HasMany
    {
        return $this->hasMany(FarmerYield::class, 'variety_id');
    }

    /**
     * Get the requirements for this crop variety.
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class, 'variety_id');
    }

    /**
     * Get the market prices for this crop variety.
     */
    public function marketPrices(): HasMany
    {
        return $this->hasMany(MarketPrice::class, 'variety_id');
    }
}
