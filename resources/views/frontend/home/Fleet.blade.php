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
                                
                                <p>{{$item->description}}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> {{$item->total_passenger}} Passengers</li>
                                    <li><i class='bx bx-expand'></i> {{ $item->car_capacity}}</li>
                                </ul>

                                
                                <a href="{{url('cars/details/'.$item->id)}}" class="book-more-btn">
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