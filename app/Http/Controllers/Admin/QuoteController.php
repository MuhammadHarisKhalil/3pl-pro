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

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Service;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the quotes.
     */
    public function index()
    {
        $quotes = Quote::with('service')->latest()->paginate(15);
        return view('admin.quotes.index', compact('quotes'));
    }

    /**
     * Display the specified quote.
     */
    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Update the specified quote status.
     */
    public function updateStatus(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,declined',
            'notes' => 'nullable|string',
        ]);

        $quote->update($validated);

        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote status updated successfully');
    }

    /**
     * Remove the specified quote.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();
        
        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote deleted successfully');
    }
}