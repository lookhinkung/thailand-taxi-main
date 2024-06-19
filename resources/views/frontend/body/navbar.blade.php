@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="index.html" class="logo">
            <img src="{{$setting->logo}}" class="logo-one" alt="Logo">
            <img src="{{$setting->logo}}" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="/">
                    <img src="{{$setting->logo}}" class="logo-one" alt="Logo">
                    <img src="{{$setting->logo}}" class="logo-two"
                        alt="Logo">
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
                            <a href="{{ route('about.us') }}" class="nav-link">
                                About Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fcar.all') }}" class="nav-link">
                                Fleet
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('blog.list') }}" class="nav-link">
                                Review
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{route('contact.us')}}" class="nav-link">
                                Contact
                            </a>
                        </li>


                        <li class="nav-item-btn">
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                        </li>
                    </ul>

                    
                </div>
            </nav>
        </div>
    </div>
</div>
