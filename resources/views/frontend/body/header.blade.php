
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-10 col-md-9">
                <div class="header-right">
                    <ul>
                        <li>
                            <i class='bx bx-home-alt'></i>
                            <a href="#">{{$setting->address}}</a>
                        </li>
                        <li>
                            <i class='bx bx-phone-call'></i>
                            <a href="tel:{{$setting->address}}">{{$setting->phone}}</a>
                        </li>

                        @auth
                            <li>
                                <i class='bx bxs-user-pin'></i>
                                <a href="{{ route('user.booking') }}">Dashboard</a>
                            </li>
                            <li>
                                <i class='bx bxs-user-rectangle'></i>
                                <a href="{{ route('user.logout') }}">Logout</a>
                            </li>
                        @else
                            <li>
                                <i class='bx bxs-user-pin'></i>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            {{-- <li>
                                <i class='bx bxs-user-rectangle'></i>
                                <a href="{{ route('register') }}">Register</a>
                            </li> --}}
                        @endauth


                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
