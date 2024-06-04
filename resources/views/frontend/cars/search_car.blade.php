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
        .form-control {
            max-height: none;
        }
        .col-lg-2, .col-md-2, .form-control {
            position: relative;
            z-index: 9999;
            height: auto;
        }
    </style>
@endsection

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
                <?php $empty_array = []; ?>

                @foreach ($cars as $item)
                    @if (old('persion') <= $item->total_passenger)
                        <div class="col-lg-6 eq_card">
                            <div class="room-card-two card_">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-4 p-0">
                                        <div class="room-card-img">
                                            <a href="{{ route('search_car_details',$item->id.'?check_in='
                                                .old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}">
                                                <img src="{{ asset('upload/carimg/' . $item->image) }}" alt="Images" style="width:100%; height:auto;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-8 p-0">
                                        <div class="room-card-content">
                                            <h3>
                    <a href="{{ route('search_car_details',$item->id.'?check_in='
                        .old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}">
                    {{ $item['type']['name'] }}</a>
                                            </h3>
                                            <span>{{ $item->short_desc }}</span>
                                            <p>{{ $item->description }}</p>
                                            <ul>
                                                <li><i class='bx bx-user'></i> {{ $item->total_passenger }} Passengers</li>
                                                <li><i class='bx bx-expand'></i> {{ $item->car_capacity }}</li>
                                            </ul>
                                            <a href="{{ route('search_car_details',$item->id.'?check_in='
                                                .old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}" class="book-more-btn">
                                                Book Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <?php array_push($empty_array, $item->id); ?>
                    @endif
                @endforeach

                @if (count($cars) == count($empty_array))
                    <p class="text-center text-danger">Sorry, No Data Found</p>
                @endif
            </div>
        </div>
    </div>
    <!-- Room Area End -->
@endsection

   