@extends('layouts.app')

@section('title', 'Page Not Found | FASTER')

@section('content')
    {{-- Hero Section --}}
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">404</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Page Not Found</p>
            </div>
        </div>
    </div>

    {{-- Error Content Section --}}
    <div class="container-fluid py-5">
        <div class="container text-center py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <i class="fas fa-map-marker-alt text-primary mb-4" style="font-size: 100px;"></i>
                    <h1 class="mb-4">Oops! Page Not Found</h1>
                    <p class="lead mb-5">We couldn't find the page you're looking for. It might have been moved, deleted, or never existed.</p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary py-3 px-5">
                            <i class="fas fa-home mr-2"></i> Return Home
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary py-3 px-5">
                            <i class="fas fa-envelope mr-2"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5 pt-5">
                <div class="col-md-4">
                    <div class="bg-primary p-4 text-center">
                        <h4 class="text-white"><i class="fas fa-shipping-fast text-dark mr-2"></i> Shipping Services</h4>
                        <p class="text-white mt-3 mb-0">Explore our premium logistics and shipping solutions</p>
                        <a href="{{ route('home') }}" class="btn btn-light mt-3">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-primary p-4 text-center">
                        <h4 class="text-white"><i class="fas fa-search text-dark mr-2"></i> Track Shipment</h4>
                        <p class="text-white mt-3 mb-0">Find your package with our real-time tracking</p>
                        <a href="{{ route('home') }}" class="btn btn-light mt-3">Go Home</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-primary p-4 text-center">
                        <h4 class="text-white"><i class="fas fa-headset text-dark mr-2"></i> Get Support</h4>
                        <p class="text-white mt-3 mb-0">Our team is ready to assist you with any questions</p>
                        <a href="{{ route('contact') }}" class="btn btn-light mt-3">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection