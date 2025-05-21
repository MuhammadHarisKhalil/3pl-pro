<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::orderBy('display_order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // Create service
        Service::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'image' => $validated['image'] ?? null,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($service->image && Storage::exists(str_replace('storage/', 'public/', $service->image))) {
                Storage::delete(str_replace('storage/', 'public/', $service->image));
            }
            
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // Update service
        $service->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'image' => $validated['image'] ?? $service->image,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service)
    {
        // Delete the image if it exists
        if ($service->image && Storage::exists(str_replace('storage/', 'public/', $service->image))) {
            Storage::delete(str_replace('storage/', 'public/', $service->image));
        }
        
        $service->delete();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully!');
    }
}