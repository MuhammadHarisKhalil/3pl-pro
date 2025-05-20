<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PricingPlan;
use App\Models\PricingFeature;

class MigratePricingData extends Command
{
    protected $signature = 'pricing:migrate';
    protected $description = 'Migrate static pricing data to database';

    public function handle()
    {
        // Clear existing data
        $this->info('Clearing existing pricing data...');
        PricingFeature::query()->delete();
        PricingPlan::query()->delete();
        
        // Define the plans
        $this->info('Creating new pricing plans...');
        
        // Common features for all plans
        $commonFeatures = [
            'HTML5 & CSS3',
            'Bootstrap 4',
            'Responsive Layout',
            'Compatible With All Browsers'
        ];
        
        // Create the plans with their features
        $plans = [
            [
                'name' => 'Basic',
                'price' => 49.00,
                'duration' => 'Monthly',
                'extra_features' => []
            ],
            [
                'name' => 'Premium',
                'price' => 99.00,
                'duration' => 'Monthly',
                'is_popular' => true,
                'extra_features' => ['Priority Support']
            ],
            [
                'name' => 'Business',
                'price' => 149.00,
                'duration' => 'Monthly',
                'extra_features' => ['Priority Support', 'Dedicated Account Manager']
            ]
        ];
        
        foreach ($plans as $index => $planData) {
            $plan = PricingPlan::create([
                'name' => $planData['name'],
                'price' => $planData['price'],
                'duration' => $planData['duration'],
                'icon' => $planData['name'] === 'Basic' ? 'box' : 
                          ($planData['name'] === 'Premium' ? 'shipping-fast' : 'building'),
                'description' => "Our {$planData['name']} plan for logistics and shipping",
                'is_popular' => $planData['is_popular'] ?? false,
                'is_active' => true,
                'display_order' => $index + 1
            ]);
            
            $this->info("Created {$planData['name']} plan");
            
            // Add common features
            foreach ($commonFeatures as $featureIndex => $featureText) {
                $plan->features()->create([
                    'feature_text' => $featureText,
                    'is_included' => true,
                    'display_order' => $featureIndex
                ]);
            }
            
            // Add extra features
            foreach ($planData['extra_features'] as $featureIndex => $featureText) {
                $plan->features()->create([
                    'feature_text' => $featureText,
                    'is_included' => true,
                    'display_order' => count($commonFeatures) + $featureIndex
                ]);
            }
        }
        
        $this->info('Pricing data migration completed!');
        
        return Command::SUCCESS;
    }
}