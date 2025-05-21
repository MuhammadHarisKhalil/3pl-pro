<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Service;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Store a newly created quote request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service_id' => 'nullable|exists:services,id',
            'message' => 'nullable|string',
        ]);

        Quote::create($validated);

        return redirect()->back()->with('success', 'Your quote request has been submitted successfully! We will contact you shortly.');
    }
}