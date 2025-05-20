{{-- filepath: /home/manafa-tech/Public/3pl/resources/views/pages/price.blade.php --}}
@extends('layouts.app')

@section('title', 'FASTER - Pricing Plan')

@section('content')
    {{-- Hero Section --}}
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Price</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Price</p>
            </div>
        </div>
    </div>

    {{-- Pricing Plan Section --}}
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Pricing Plan</h6>
                <h1 class="mb-4">Affordable Pricing Packages</h1>
            </div>
            <div class="row">
                @forelse(\App\Models\PricingPlan::where('is_active', true)->orderBy('display_order')->with('features')->get() as $plan)
                    <div class="col-md-4 mb-5">
                        <div class="bg-secondary position-relative">
                            @if($plan->is_popular)
                                <div class="position-absolute" style="top: -15px; left: 50%; transform: translateX(-50%);">
                                    <span class="badge bg-danger text-white px-4 py-2">Popular</span>
                                </div>
                            @endif
                            <div class="text-center p-4">
                                <h1 class="display-4 mb-0">
                                    <small class="align-top text-muted font-weight-medium" style="font-size: 22px; line-height: 45px;">$</small>{{ number_format($plan->price, 0) }}<small class="align-bottom text-muted font-weight-medium" style="font-size: 16px; line-height: 40px;">/{{ substr($plan->duration, 0, 2) }}</small>
                                </h1>
                            </div>
                            <div class="bg-primary text-center p-4">
                                <h3 class="m-0">{{ $plan->name }}</h3>
                            </div>
                            <div class="d-flex flex-column align-items-center py-4">
                                @foreach($plan->features as $feature)
                                    <p>{{ $feature->feature_text }}</p>
                                @endforeach
                                <a href="{{ route('contact') }}?plan={{ $plan->id }}" class="btn btn-primary py-2 px-4 my-2">Order Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p>No pricing plans available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Testimonial Section --}}
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Testimonial</h6>
                <h1 class="mb-4">Our Clients Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @foreach($testimonials ?? [] as $testimonial)
                    <div class="position-relative bg-secondary p-4">
                        <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid rounded-circle" src="{{ asset($testimonial->image) }}" style="width: 60px; height: 60px;" alt="{{ $testimonial->name }}">
                            <div class="ml-3">
                                <h6 class="font-weight-semi-bold m-0">{{ $testimonial->name }}</h6>
                                <small>- {{ $testimonial->profession }}</small>
                            </div>
                        </div>
                        <p class="m-0">{{ $testimonial->message }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

