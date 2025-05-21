<!-- filepath: /home/manafa-tech/Public/3pl/resources/views/pages/service-detail.blade.php -->
@extends('layouts.app')

@section('title', $service->title)

@section('content')
    {{-- Hero Section --}}
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">{{ $service->title }}</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0"><a class="text-white" href="{{ route('services') }}">Services</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">{{ $service->title }}</p>
            </div>
        </div>
    </div>

    {{-- Service Detail Section --}}
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                @if($service->image)
                    <div class="mb-4">
                        <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="img-fluid rounded">
                    </div>
                @endif
                
                <h2 class="mb-4">{{ $service->title }}</h2>
                
                <div class="content">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Other Services</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach(\App\Models\Service::where('id', '!=', $service->id)->active()->orderBy('display_order')->limit(5)->get() as $otherService)
                                <a href="{{ route('services.detail', $otherService->slug) }}" class="list-group-item list-group-item-action">
                                    <i class="fa fa-{{ $otherService->icon ?? 'angle-right' }} mr-2 text-primary"></i>{{ $otherService->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Get a Quote</h5>
                    </div>
                    <div class="card-body bg-secondary">
                        <p>Need more information about this service? Contact us for a customized quote.</p>
                        <a href="{{ route('contact') }}?service={{ $service->slug }}" class="btn btn-primary btn-block py-3">Request a Quote</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection