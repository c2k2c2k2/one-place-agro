<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'source',
        'published_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to get recent news.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('published_at', '>=', now()->subDays($days))
            ->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to order by latest first.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to filter by source.
     */
    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }
}
