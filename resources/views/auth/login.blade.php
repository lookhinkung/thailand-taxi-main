@extends('frontend.main_master')
@section('main')
<style>
.sign-in-area {
    padding-top: 100px;
    padding-bottom: 70px;
}

.section-title .sp-color {
    color: #4285F4; /* Example color */
}

.form-group input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-condition .agree-label {
    display: flex;
    align-items: center;
}

.form-condition .agree-label input {
    margin-right: 10px;
}

.default-btn {
    background-color: #f47142;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.default-btn:hover {
    background-color: #fc8600;
}

.google-login-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background-color: #4285F4;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    font-size: 24px;
    margin-top: 1px;
}

.google-login-icon:hover {
    background-color: #000000;
}

.account-desc {
    margin-top: 20px;
}

.text-danger {
    color: #dc3545;
}

.mt-3 {
    margin-top: 20px;
}

}
</style>
<!-- Inner Banner -->
{{-- <div class="inner-banner inner-bg9">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Sign In</li>
            </ul>
            <h3>Sign In</h3>
        </div>
    </div>
</div> --}}
<!-- Inner Banner End -->


<!-- Sign In Area -->
<div class="sign-in-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-all-form">
                    <div class="contact-form">
                        <div class="section-title text-center">
                            <span class="sp-color">Sign In</span>
                            <h2>Sign In to Your Account!</h2>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="login" id="login" class="form-control @error('login') is-invalid @enderror" 
                                        required data-error="Please enter your Username or Email" 
                                        placeholder="Email/Name/Phone">
                                        @error('login')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" id="password" type="password" name="password" 
                                        placeholder="Password">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 form-condition">
                                    <div class="agree-label">
                                        <input type="checkbox" id="chb1">
                                        <label for="chb1">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6">
                                    <a class="forget" href="{{route('password.request')}}">Forgot My Password?</a>
                                </div>

                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Sign In Now
                                    </button>
                                </div>

                                <div class="col-lg-12 col-md-12 text-center mt-3">
                                    <a href="{{ route('google-auth') }}" class="google-login-icon">
                                        <i class='bx bxl-google'></i>
                                    </a>
                                </div>

                                <div class="col-12 text-center mt-3">
                                    <p class="account-desc">
                                        Not a Member?
                                        <a href="{{route('register')}}">Sign Up</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sign In Area End -->

@endsection