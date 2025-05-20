<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'duration', 'icon', 'description', 
        'is_popular', 'is_active', 'display_order'
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Get the features for the pricing plan.
     */
    public function features()
    {
        return $this->hasMany(PricingFeature::class)->orderBy('display_order');
    }

    /**
     * Get active plans ordered by display order
     */
    public static function getActivePlans()
    {
        return self::where('is_active', true)
            ->orderBy('display_order')
            ->with('features')
            ->get();
    }
}