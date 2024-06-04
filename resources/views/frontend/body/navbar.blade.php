<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="{{asset('frontend/assets/img/logos/logo-1.png')}}" class="logo-one" alt="Logo">
            <img src="{{asset('frontend/assets/img/logos/footer-logo1.png')}}" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="index.html">
                    <img src="{{asset('frontend/assets/img/logos/logo-1.png')}}" class="logo-one" alt="Logo">
                    <img src="{{asset('frontend/assets/img/logos/footer-logo1.png')}}" class="logo-two" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link active">
                                Home 
                            </a>
                        </li>

@php
    $car = App\Models\Car::latest()->get();
@endphp
                        <li class="nav-item">
                            <a class="nav-link">
                                About
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('about.us')}}" class="nav-link active">
                                        About Us  
                                    </a>
                                </li>
                               {{-- @foreach ($car as $item) --}}
                                <li class="nav-item">
                                    <a href="{{route('fcar.all')}}" class="nav-link">
                                        {{-- {{$item['type']['name']}} --}}
                                        Fleet
                                    </a>
                                </li>
                                {{-- @endforeach --}}
                            </ul>
                        </li>
                        

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Services 
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="services-1.html" class="nav-link">
                                        Services Style One 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="services-2.html" class="nav-link">
                                        Services Style Two 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="service-details.html" class="nav-link">
                                        Service Details 
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <i class='bx bxs-plane-alt'></i>
                            <a href="#" class="">
                                Airport transfer
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Reviews
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Booking
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link">
                                Contact
                            </a>
                        </li>
                        

                        <li class="nav-item-btn">
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                        </li>
                    </ul>

                    <div class="nav-btn">
                        <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>