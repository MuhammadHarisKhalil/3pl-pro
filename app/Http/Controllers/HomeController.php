<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        $testimonials = \App\Models\Testimonial::active()->orderBy('display_order')->get();
        return view('pages.services', compact('testimonials'));
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
