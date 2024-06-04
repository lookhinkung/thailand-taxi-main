@extends('frontend.main_master')
@section('style')
<style>
    .eq_card {
        display: flex;
        flex-direction: column;
    }
    .eq_card .card_ {
        flex: 1;
    }
    .banner-form-area {
        position: relative;
        z-index: 100;
    }
    .room-area {
        position: relative;
        z-index: 1;
    }
    .dropdown-menu {
        z-index: 2000;
    }
</style>
@endsection
@section('main')
<!-- Banner Area -->
<div class="banner-area" style="height: 480px;">
    <div class="container">
        <div class="banner-content">
            <h1>Premium Taxi Cab Transger Services in Thailand</h1>
       
        </div>
    </div>
</div>
<!-- Banner Area End -->

<!-- Banner Form Area -->
<div class="banner-form-area">
    <div class="container">
        <div class="banner-form">
            <form method="GET" action="{{route('booking.search')}}">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK IN TIME</label>
                            <div class="input-group">
    <input autocomplete="off" type="text" required name="check_in" class="form-control dt_picker" 
    placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label>CHECK OUT TIME</label>
                            <div class="input-group">
    <input autocomplete="off" type="text" required name="check_out" class="form-control dt_picker" 
    placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                            </div>
                            <i class='bx bxs-chevron-down'></i>	
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label>GUESTS</label>
                            <select name="persion" class="form-control">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                @endfor
                            </select>	
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <button type="submit" class="default-btn btn-bg-one border-radius-5">
                            Check Availability
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Banner Form Area End -->

<!-- Room Area -->
@include('frontend.home.Fleet')
<!-- Room Area End -->

<!-- Book Area Two-->
@include('frontend.home.Fleet_two')
<!-- Book Area Two End -->

<!-- Services Area Three -->
@include('frontend.home.services')
<!-- Services Area Three End -->

<!-- Team Area Three -->
@include('frontend.home.team')
<!-- Team Area Three End -->

<!-- Testimonials Area Three -->
@include('frontend.home.testimonials')
<!-- Testimonials Area Three End -->

<!-- FAQ Area -->
{{-- @include('frontend.home.faq') --}}
<!-- FAQ Area End -->

<!-- Blog Area -->
@include('frontend.home.blog')
<!-- Blog Area End -->

@endsection