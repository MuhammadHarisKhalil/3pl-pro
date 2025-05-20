<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the pricing plans.
     */
    public function index()
    {
        $plans = PricingPlan::orderBy('display_order')->get();
        return view('admin.pricing.index', compact('plans'));
    }

    /**
     * Show the form for creating a new pricing plan.
     */
    public function create()
    {
        return view('admin.pricing.create');
    }

    /**
     * Store a newly created pricing plan in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:50',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
            'features' => 'nullable|array',
            'features.*.feature_text' => 'required|string',
            'features.*.is_included' => 'boolean',
        ]);

        // Create pricing plan
        $plan = PricingPlan::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'icon' => $validated['icon'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_popular' => $validated['is_popular'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        // Create features if any
        if (isset($validated['features'])) {
            foreach ($validated['features'] as $index => $feature) {
                $plan->features()->create([
                    'feature_text' => $feature['feature_text'],
                    'is_included' => $feature['is_included'] ?? true,
                    'display_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan created successfully!');
    }

    /**
     * Show the form for editing the specified pricing plan.
     */
    public function edit(PricingPlan $pricing)
    {
        $pricing->load('features');
        return view('admin.pricing.edit', ['plan' => $pricing]);
    }

    /**
     * Update the specified pricing plan in storage.
     */
    public function update(Request $request, PricingPlan $pricing)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:50',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_popular' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
            'features' => 'nullable|array',
            'features.*.id' => 'nullable|integer|exists:pricing_features,id',
            'features.*.feature_text' => 'required|string',
            'features.*.is_included' => 'boolean',
        ]);

        // Update pricing plan
        $pricing->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'icon' => $validated['icon'] ?? null,
            'description' => $validated['description'] ?? null,
            'is_popular' => $validated['is_popular'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        // Handle features
        if (isset($validated['features'])) {
            // Get existing feature IDs for this plan
            $existingFeatureIds = $pricing->features->pluck('id')->toArray();
            $updatedFeatureIds = [];
            
            foreach ($validated['features'] as $index => $feature) {
                if (isset($feature['id'])) {
                    // Update existing feature
                    $updatedFeatureIds[] = $feature['id'];
                    PricingFeature::find($feature['id'])->update([
                        'feature_text' => $feature['feature_text'],
                        'is_included' => $feature['is_included'] ?? true,
                        'display_order' => $index,
                    ]);
                } else {
                    // Create new feature
                    $pricing->features()->create([
                        'feature_text' => $feature['feature_text'],
                        'is_included' => $feature['is_included'] ?? true,
                        'display_order' => $index,
                    ]);
                }
            }
            
            // Delete features that are no longer in the list
            $featuresToDelete = array_diff($existingFeatureIds, $updatedFeatureIds);
            if (!empty($featuresToDelete)) {
                PricingFeature::whereIn('id', $featuresToDelete)->delete();
            }
        } else {
            // If no features provided, delete all existing features
            $pricing->features()->delete();
        }

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan updated successfully!');
    }

    /**
     * Remove the specified pricing plan from storage.
     */
    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();
        
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan deleted successfully!');
    }
}