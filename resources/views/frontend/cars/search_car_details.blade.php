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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

<form action="{{route('user_booking_store',$cardetails->id)}}" method="post" id="bk_form">
    @csrf

    <input type="hidden" name="car_id" value="{{ $cardetails->id }}">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Check in</label>
                <div class="input-group">
<input autocomplete="off" type="text" required name="check_in" id="check_in" class="form-control dt_picker" 
                   value="{{old('check_in')?date('Y-m-d',strtotime(old('check_in'))) : ''}}">
                    <span class="input-group-addon"></span>
                </div>
                <i class='bx bxs-calendar'></i>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Check Out</label>
                <div class="input-group">
                    <input autocomplete="off" type="text" required name="check_out" id="check_out" class="form-control dt_picker" 
                   value="{{old('check_out')?date('Y-m-d',strtotime(old('check_out'))) : ''}}">
                    <span class="input-group-addon"></span>
                </div>
                <i class='bx bxs-calendar'></i>
            </div>
        </div>

        <input type="hidden" id="total_passenger" value="{{$cardetails->total_passenger}}">

        <div class="col-lg-12">
            <div class="form-group">
                <label>Numbers of Guest</label>
                <select class="form-control" name="persion" id="nmbr_person">
                    @for ($i = 1; $i <= 10; $i++)
                    <option {{old('persion')==$i ?'selected':''}} value="{{$i}}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                @endfor
                    
                    
                </select>
            </div>

            <div class="form-group">
                <label>Car number</label>
                <select class="form-control" name="persion" id="nmbr_person">
                    @for ($i = 1; $i <= 10; $i++)
                    <option {{old('persion')==$i ?'selected':''}} value="{{$i}}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                @endfor
                    
                    
                </select>
            </div>
            <input type="hidden" name="available_car" id="available_car">
            <p class="available_car"></p>
            {{-- <p class="text text-success">Fleet Available</p> --}}
        </div>




            <div class="col-lg-12">
                <table class="table">
                    
                    <tbody>
                      <tr>
                        <td>
                            <p>Total Days</p>    
                        </td>
                        <td style="text-align: right"><span id="t_days"> 0 </span></td>
                      </tr>
                      
                    </tbody>
                  </table>
            </div>

        <div class="col-lg-12 col-md-12">
            <button type="submit" class="default-btn btn-bg-three border-radius-5">
                Book Now
            </button>
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
                                                        Seats <i class='bx bxs-cloud-download'></i></a>
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
                                    <a href="{{url('cars/details/'.$item->id)}}">
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
    
     <script>
    $(document).ready(function () {
       var check_in = "{{ old('check_in') }}";
       var check_out = "{{ old('check_out') }}";
       var car_id = "{{ $car_id }}";
       if (check_in != '' && check_out != '') {
            calculateTotalDays(check_in, check_out);
        }

        $("#check_in, #check_out").on('change', function () {
            var check_in = $("#check_in").val();
            var check_out = $("#check_out").val();
            if (check_in != '' && check_out != '') {
                calculateTotalDays(check_in, check_out);
            }
        });

        function calculateTotalDays(check_in, check_out) {
            var startDate = new Date(check_in);
            var endDate = new Date(check_out);
            var timeDifference = endDate.getTime() - startDate.getTime();
            var totalDays = Math.ceil(timeDifference / (1000 * 3600 * 24));
            $("#t_days").text(totalDays > 0 ? totalDays : 0);
        }
       
       if (check_in != '' && check_out != ''){
          getAvaility(check_in, check_out, car_id);
       }
       $("#check_out").on('change', function () {
          var check_out = $(this).val();
          var check_in = $("#check_in").val();
          if(check_in != '' && check_out != ''){
             getAvaility(check_in, check_out, car_id);
          }
       });
       $(".number_of_cars").on('change', function () {
          var check_out = $("#check_out").val();
          var check_in = $("#check_in").val();
          if(check_in != '' && check_out != ''){
             getAvaility(check_in, check_out, car_id);
          }
       });
    });
    function getAvaility(check_in, check_out, car_id) {
       $.ajax({
          url: "{{ route('check_car_availability') }}",
          data: {car_id:car_id, check_in:check_in, check_out:check_out},
          success: function(data){
             $(".available_car").html('Availability : <span class="text-success">'+data['available_car']+' cars</span>');
             $("#available_car").val(data['available_car']);
             price_calculate(data['total_nights']);
          }
       });
    }
    function price_calculate(total_nights){
       var car_price = $("#car_price").val();
       var discount_p = $("#discount_p").val();
       var select_car = $("#select_car").val();
       var sub_total = car_price * total_nights * parseInt(select_car);
       var discount_price = (parseInt(discount_p)/100)*sub_total;
       $(".t_subtotal").text(sub_total);
       $(".t_discount").text(discount_price);
       $(".t_g_total").text(sub_total-discount_price);
    }
    $("#bk_form").on('submit', function () {
       var av_car = $("#available_car").val();
       var select_car = $("#select_car").val();
       if (parseInt(select_car) >  av_car){
          alert('Sorry, you select maximum number of car');
          return false;
       }
       var nmbr_person = $("#nmbr_person").val();
       var total_adult = $("#total_adult").val();
       if(parseInt(nmbr_person) > parseInt(total_adult)){
          alert('Sorry, you select maximum number of person');
          return false;
       }
    })
 </script>
    </script>
@endsection



