{{-- filepath: /home/manafa-tech/Public/3pl/resources/views/pages/about.blade.php --}}
@extends('layouts.app')

@section('title', 'FASTER - About Us')

@section('content')
    {{-- Hero Section --}}
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-white display-3">About Us</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="{{ route('home') }}">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">About</p>
            </div>
        </div>
    </div>

    {{-- About Section --}}
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <img class="img-fluid w-100" src="{{ asset('img/about.jpg') }}" alt="About Us">
                    <div class="bg-primary text-dark text-center p-4">
                        <h3 class="m-0">25+ Years Experience</h3>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">About Us</h6>
                    <h1 class="mb-4">Trusted & Faster Logistic Service Provider</h1>
                    <p class="mb-4">We provide reliable and efficient logistics services tailored to meet your needs. With over 25 years of experience, we ensure safe and timely delivery of your goods.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-3 py-2 px-4">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Why Choose Us Section --}}
    <div class="container-fluid bg-secondary my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid w-100" src="{{ asset('img/feature.jpg') }}" alt="Why Choose Us">
                </div>
                <div class="col-lg-7 py-5 py-lg-0">
                    <h6 class="text-primary text-uppercase font-weight-bold">Why Choose Us</h6>
                    <h1 class="mb-4">Faster, Safe, and Trusted Logistics Services</h1>
                    <p class="mb-4">We prioritize customer satisfaction with our industry-leading services, emergency support, and 24/7 availability.</p>
                    <ul class="list-inline">
                        <li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Best In Industry</h6></li>
                        <li><h6><i class="far fa-dot-circle text-primary mr-3"></i>Emergency Services</h6></li>
                        <li><h6><i class="far fa-dot-circle text-primary mr-3"></i>24/7 Customer Support</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Delivery Team Section --}}
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Delivery Team</h6>
                <h1 class="mb-4">Meet Our Delivery Team</h1>
            </div>
            <div class="row">
                @foreach($teamMembers ?? [] as $member)
                    <div class="col-lg-3 col-md-6">
                        <div class="team card position-relative overflow-hidden border-0 mb-5">
                            <img class="card-img-top" src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                            <div class="card-body text-center p-0">
                                <div class="team-text d-flex flex-column justify-content-center bg-secondary">
                                    <h5 class="font-weight-bold">{{ $member->name }}</h5>
                                    <span>{{ $member->designation }}</span>
                                </div>
                                <div class="team-social d-flex align-items-center justify-content-center bg-primary">
                                    <a class="btn btn-outline-dark btn-social mr-2" href="{{ $member->twitter }}"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-dark btn-social mr-2" href="{{ $member->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-dark btn-social mr-2" href="{{ $member->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                    <a class="btn btn-outline-dark btn-social" href="{{ $member->instagram }}"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-play').click(function () {
                var videoSrc = $(this).data('src');
                $('#videoModal iframe').attr('src', videoSrc);
                $('#videoModal').modal('show');
            });

            $('#videoModal').on('hidden.bs.modal', function () {
                $('#videoModal iframe').attr('src', '');
            });
        });
    </script>
@endsection