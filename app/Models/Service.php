<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'short_description', 'description', 
        'icon', 'image', 'is_featured', 'is_active', 'display_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when creating a new service
        static::creating(function ($service) {
            if (!$service->slug) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured services.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get all active services ordered by display order.
     */
    public static function getActiveServices()
    {
        return self::active()
            ->orderBy('display_order')
            ->get();
    }

    /**
     * Get featured services for homepage.
     */
    public static function getFeaturedServices($limit = 6)
    {
        return self::active()
            ->featured()
            ->orderBy('display_order')
            ->limit($limit)
            ->get();
    }
}