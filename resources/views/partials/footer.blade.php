<div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
    <div class="row pt-5">
        <div class="col-lg-7 col-md-6">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h3 class="text-primary mb-4">Get In Touch</h3>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>{{ config('company.address', '123 Street, New York, USA') }}</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>{{ config('company.phone', '+012 345 67890') }}</p>
                    <p><i class="fa fa-envelope mr-2"></i>{{ config('company.email', 'info@example.com') }}</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="btn btn-outline-light btn-social mr-2" href="{{ config('social.twitter', '#') }}"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mr-2" href="{{ config('social.facebook', '#') }}"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mr-2" href="{{ config('social.linkedin', '#') }}"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social" href="{{ config('social.instagram', '#') }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-primary mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-white mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-white mb-2" href="{{ route('about') }}"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                        <a class="text-white mb-2" href="{{ route('services') }}"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                        <a class="text-white mb-2" href="{{ route('price') }}"><i class="fa fa-angle-right mr-2"></i>Pricing Plan</a>
                        <a class="text-white" href="{{ route('contact') }}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6 mb-5">
            <h3 class="text-primary mb-4">Newsletter</h3>
            <p>Stay updated with our latest news and offers by subscribing to our newsletter</p>
            <div class="w-100">
                <form action="{{ route('home') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
    <div class="row">
        <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
            <p class="m-0 text-white">&copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ config('app.name', 'Faster') }}</a>. All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 text-center text-md-right">
            <ul class="nav d-inline-flex">
                <li class="nav-item">
                    <a class="nav-link text-white py-0" href="#">Privacy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white py-0" href="#">Terms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white py-0" href="#">FAQs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white py-0" href="#">Help</a>
                </li>
            </ul>
        </div>
    </div>
</div>
