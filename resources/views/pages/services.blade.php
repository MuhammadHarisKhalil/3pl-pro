@extends('layouts.app')

@section('title', 'FASTER - Our Services')

@section('content')
    {{-- Hero Section --}}
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">Services</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Services</p>
            </div>
        </div>
    </div>

    {{-- Services Section --}}
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Our Services</h6>
                <h1 class="mb-4">Best Logistics Services</h1>
            </div>
            <div class="row pb-3">
                @forelse(\App\Models\Service::getActiveServices() as $service)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-0 shadow-sm mb-2">
                            @if($service->image)
                                <img class="card-img-top" src="{{ asset($service->image) }}" alt="{{ $service->title }}">
                            @endif
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px;">
                                        <i class="fa fa-{{ $service->icon ?? 'truck' }}"></i>
                                    </div>
                                    <h4 class="m-0 ml-3 text-truncate">{{ $service->title }}</h4>
                                </div>
                                <p>{{ $service->short_description }}</p>
                                <a class="text-primary font-weight-semi-bold" href="{{ route('services.detail', $service->slug) }}">Read More <i class="fa fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p>No services available at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="container-fluid pb-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Why Choose Us</h6>
                <h1 class="mb-4">Best Transport Features</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px;">
                            <i class="fa fa-2x fa-ship"></i>
                        </div>
                        <div class="pl-4">
                            <h5 class="font-weight-bold">Ocean Freight</h5>
                            <p class="m-0">Global ocean transport solutions for your business needs</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px;">
                            <i class="fa fa-2x fa-truck"></i>
                        </div>
                        <div class="pl-4">
                            <h5 class="font-weight-bold">Land Transport</h5>
                            <p class="m-0">Reliable ground transportation anywhere you need</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px;">
                            <i class="fa fa-2x fa-plane"></i>
                        </div>
                        <div class="pl-4">
                            <h5 class="font-weight-bold">Air Freight</h5>
                            <p class="m-0">Fast and secure air freight for time-sensitive shipments</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection