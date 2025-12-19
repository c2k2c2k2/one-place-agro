<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'role',
        'location',
        'avatar',
        'company_name',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Get the yields for the farmer.
     */
    public function yields(): HasMany
    {
        return $this->hasMany(FarmerYield::class);
    }

    /**
     * Get the requirements for the trader.
     */
    public function requirements(): HasMany
    {
        return $this->hasMany(Requirement::class);
    }

    /**
     * Get the bids placed by the trader.
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class, 'trader_id');
    }

    /**
     * Get the notifications for the user.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the unread notifications for the user.
     */
    public function unreadNotifications(): HasMany
    {
        return $this->hasMany(Notification::class)->where('is_read', false);
    }

    /**
     * Check if user is a farmer.
     */
    public function isFarmer(): bool
    {
        return $this->role === 'farmer';
    }

    /**
     * Check if user is a trader.
     */
    public function isTrader(): bool
    {
        return $this->role === 'trader';
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
