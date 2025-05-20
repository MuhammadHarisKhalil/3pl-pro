<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\PricingFeature;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing plans
        PricingFeature::query()->delete();
        PricingPlan::query()->delete();
        
        // Common features for all plans
        $commonFeatures = [
            'HTML5 & CSS3',
            'Bootstrap 4',
            'Responsive Layout',
            'Compatible With All Browsers'
        ];
        
        // Create Basic Plan
        $basicPlan = PricingPlan::create([
            'name' => 'Basic',
            'price' => 49.00,
            'duration' => 'Monthly',
            'icon' => 'box',
            'description' => 'Perfect for small businesses just getting started',
            'is_popular' => false,
            'is_active' => true,
            'display_order' => 1
        ]);
        
        // Create Premium Plan
        $premiumPlan = PricingPlan::create([
            'name' => 'Premium',
            'price' => 99.00,
            'duration' => 'Monthly',
            'icon' => 'shipping-fast',
            'description' => 'Great for growing businesses with more requirements',
            'is_popular' => true,
            'is_active' => true,
            'display_order' => 2
        ]);
        
        // Create Business Plan
        $businessPlan = PricingPlan::create([
            'name' => 'Business',
            'price' => 149.00,
            'duration' => 'Monthly',
            'icon' => 'building',
            'description' => 'Complete solution for large enterprises',
            'is_popular' => false,
            'is_active' => true,
            'display_order' => 3
        ]);
        
        // Add common features to all plans
        foreach ([$basicPlan, $premiumPlan, $businessPlan] as $index => $plan) {
            foreach ($commonFeatures as $featureIndex => $featureText) {
                $plan->features()->create([
                    'feature_text' => $featureText,
                    'is_included' => true,
                    'display_order' => $featureIndex
                ]);
            }
        }
        
        // Add extra features to premium and business plans
        $premiumPlan->features()->create([
            'feature_text' => 'Priority Support',
            'is_included' => true,
            'display_order' => 4
        ]);
        
        $businessPlan->features()->create([
            'feature_text' => 'Priority Support',
            'is_included' => true,
            'display_order' => 4
        ]);
        
        $businessPlan->features()->create([
            'feature_text' => 'Dedicated Account Manager',
            'is_included' => true,
            'display_order' => 5
        ]);
    }
}