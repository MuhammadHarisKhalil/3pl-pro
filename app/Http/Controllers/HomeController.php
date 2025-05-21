<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $services = \App\Models\Service::active()->orderBy('display_order')->get();
        return view('pages.home', compact('services'));
    }

    public function about()
    {
        return view('pages.about');
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        return view('pages.services');
    }

    /**
     * Display a specific service.
     */
    public function serviceDetail(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }
        
        return view('pages.service-detail', compact('service'));
    }

    public function price()
    {
        $testimonials = \App\Models\Testimonial::active()->orderBy('display_order')->get();
        return view('pages.price', compact('testimonials'));
    }

    public function blog()
    {
        return view('pages.blog');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
