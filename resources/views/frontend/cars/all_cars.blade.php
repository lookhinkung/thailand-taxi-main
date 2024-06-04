@extends('frontend.main_master')
@section('main')
     <!-- Inner Banner -->
     <div class="inner-banner inner-bg9">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>Fleet</li>
                </ul>
                <h3>Fleet</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Room Area -->
    <div class="room-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <span class="sp-color">Fleets</span>
                <h2>Our Fleets</h2>
            </div>
            <div class="row pt-45">
                @foreach ($cars as $item)

                <div class="col-lg-4 col-md-6">
                    <div class="room-card">
                        <a href="{{url('cars/details/'.$item->id)}}">
                            <img src="{{asset('upload/carimg/'.$item->image)}}" alt="Images"
                            style="width:550px; height:300;">
                        </a>
                        <div class="content">
                            <h3><a href="{{url('cars/details/'.$item->id)}}">{{$item['type']['name']}}</a></h3>
                            <ul>
                            
                                <li class="text-color">{{ $item->car_capacity}}</li>
                                {{-- <li class="text-color">Per Night</li> --}}
                            </ul>
                            
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Room Area End -->
@endsection