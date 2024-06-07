@php
    $car = App\Models\Car::latest()->limit(6)->get();
@endphp

<div class="room-area pt-100 pb-70 section-bg" style="background-color:#ffffff">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">Fleets</span>
            <h2>Our Fleets</h2>
        </div>
        <div class="row pt-45">

            @foreach ($car as $item)

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