@extends('frontend.main_master')
@section('style')
    <style>
        .eq_card{
            display: flex;
            flex-direction: column;
        }
        .eq_card .card_{
            flex: 1;
        }
    </style>
@endsection
@section('main')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg10">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>car Details </li>
                </ul>
                <h3>{{ $cardetails->type->name }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- car Details Area End -->
    <div class="car-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="car-details-side">
                        <div class="side-bar-form">
                            <h3>Booking Sheet </h3>
                            <form>
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check in</label>
                                            <div class="input-group">
                                                <input id="datetimepicker" type="text" class="form-control"
                                                    placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class='bx bxs-calendar'></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check Out</label>
                                            <div class="input-group">
                                                <input id="datetimepicker-check" type="text" class="form-control"
                                                    placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class='bx bxs-calendar'></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Guest</label>
                                            <select class="form-control" name="persion" id="nmbr_person">
                                                @for ($i = 1; $i <= 10; $i++)
                                                <option {{old('persion')==$i ?'selected':''}} value="{{$i}}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endfor
                                                
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <a href="{{route('checkout')}}"  type="submit" class="default-btn btn-bg-three border-radius-5">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="room-details-article">
                        <div class="room-details-slider owl-carousel owl-theme">
                            @foreach ($multiImage as $image)
                                <div class="car-details-item">
                                    <img src="{{ asset('upload/carimg/multi_img/' . $image->multi_img) }}" alt="Images">
                                    
                                </div>
                            @endforeach
                        </div>

                        <div class="car-details-title">
                            <h2>{{ $cardetails->type->name }}</h2>
                            <ul>

                                <li>
                                    <b> {{ $cardetails->short_desc }} Passengers</b>
                                </li>

                            </ul>
                        </div>

                        <div class="car-details-content">
                            <p>
                                {!! $cardetails->description !!}
                            </p>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="services-bar-widget">
                                        <h3 class="title">Car Details</h3>
                                        <div class="side-bar-list">
                                            <ul>
                                                <li>
                                                    <a href="#"> <b>Seats : </b> {{ $cardetails->total_passenger }}
                                                        Passenger <i class='bx bxs-cloud-download'></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"> <b>Capacity : </b> {{ $cardetails->car_capacity }} <i
                                                            class='bx bxs-cloud-download'></i></a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>



                    </div>

                    <div class="car-details-review">
                        <h2>Clients Review and Retting's</h2>
                        <div class="review-ratting">
                            <h3>Your retting: </h3>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" cols="30" rows="8" required data-error="Write your message"
                                            placeholder="Write your review here.... "></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three">
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- car Details Area End -->

    <!-- car Details Other -->
    <div class="room-details-other pb-70">
        <div class="container">
            <div class="room-details-text">
                <h2>Other Fleets</h2>
            </div>

            <div class="row ">
                @foreach ($otherCars as $item)
                    
                
                <div class="col-lg-6 eq_card">
                    <div class="room-card-two card_">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="room-card-img">
                                    <a href="room-details.html">
                                        <img src="{{asset('upload/carimg/'.$item->image)}}" alt="Images">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="room-card-content">
                                    <h3>
                                        <a href="{{url('cars/details/'.$item->id)}}">{{$item['type']['name']}}</a>
                                    </h3>
                                    <span>{{$item->short_desc}}</span>
                                    {{-- <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div> --}}
                                    <p>{{$item->description}}</p>
                                    <ul>
                                        <li><i class='bx bx-user'></i> {{$item->total_passenger}} Passengers</li>
                                        <li><i class='bx bx-expand'></i> {{ $item->car_capacity}}</li>
                                    </ul>

                                    {{-- <ul>
                                        <li><i class='bx bx-show-alt'></i> Sea Balcony</li>
                                        <li><i class='bx bxs-hotel'></i> Kingsize / Twin</li>
                                    </ul> --}}

                                    <a href="car-details.html" class="book-more-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                
            </div>
        </div>
    </div>
    <!-- car Details Other End -->
@endsection



