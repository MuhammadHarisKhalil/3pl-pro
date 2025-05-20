<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('display_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // Create testimonial
        Testimonial::create([
            'name' => $validated['name'],
            'profession' => $validated['profession'],
            'message' => $validated['message'],
            'image' => $validated['image'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'message' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($testimonial->image && Storage::exists(str_replace('storage/', 'public/', $testimonial->image))) {
                Storage::delete(str_replace('storage/', 'public/', $testimonial->image));
            }
            
            $imagePath = $request->file('image')->store('testimonials', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // Update testimonial
        $testimonial->update([
            'name' => $validated['name'],
            'profession' => $validated['profession'],
            'message' => $validated['message'],
            'image' => $validated['image'] ?? $testimonial->image,
            'is_active' => $validated['is_active'] ?? true,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        // Delete the image if it exists
        if ($testimonial->image && Storage::exists(str_replace('storage/', 'public/', $testimonial->image))) {
            Storage::delete(str_replace('storage/', 'public/', $testimonial->image));
        }
        
        $testimonial->delete();
        
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }
}