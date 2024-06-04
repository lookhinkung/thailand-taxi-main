<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-10 col-md-10">
                <div class="header-right">
                    <ul>
                        <li>
                            <i class='bx bx-home-alt'></i>
                            <a href="#">53 M6, Haad Chao Samran Road,
                                Tumbol Nong Plub, Muang
                                Phetchaburi</a>
                        </li>
                        <li>
                            <i class='bx bx-phone-call'></i>
                            <a href="tel:+1-(123)-456-7890">(+66) 098 262 3132</a>
                        </li>

                        @auth
                            <li>
                                <i class='bx bxs-user-pin'></i>
                                <a href="{{ route('dashboard') }}">Dashboard</a>
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
                            <li>
                                <i class='bx bxs-user-rectangle'></i>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth


                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
