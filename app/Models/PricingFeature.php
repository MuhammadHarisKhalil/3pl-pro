<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_plan_id', 'feature_text', 'is_included', 'display_order'
    ];

    protected $casts = [
        'is_included' => 'boolean',
    ];

    /**
     * Get the plan that owns the feature.
     */
    public function plan()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id');
    }
}