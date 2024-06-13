@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @php
        $bookings = App\Models\Booking::latest()->get();
        use App\Models\Booking;

        $pending = Booking::where('status', '0')->whereDoesntHave('assign_cars')->get();

        $ongoing = Booking::where('status', 0)
            ->whereHas('assign_cars', function ($query) {
                $query->whereNotNull('car_id'); // Assuming car_id is the field that indicates a car is assigned
            })
            ->get();
        $complete = App\Models\Booking::where('status', 1)->get();
        $today = Carbon\Carbon::now()->toDateString();
        $todayBookingsCount = Booking::whereDate('created_at', Carbon\Carbon::today())->count();

        $allData = App\Models\Booking::orderBy('id', 'desc')->limit(10)->get();

    @endphp

    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Booking</p>
                                <h4 class="my-1 text-info">{{ count($bookings) }} </h4>
                                <p class="mb-0 font-13">Today Booking: {{ $todayBookingsCount }}</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pending Booking</p>
                                <h4 class="my-1 text-danger">{{ count($pending) }}</h4>
                                <p class="mb-0 font-13">+5.4% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">On-going Booking</p>
                                <h4 class="my-1 text-warning">{{ count($ongoing) }}</h4>
                                <p class="mb-0 font-13">+8.4% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                    class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Complete Booking</p>
                                <h4 class="my-1 text-success">{{ count($complete) }}</h4>
                                <p class="mb-0 font-13">-4.5% from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            {{-- <div class="col-12 col-lg-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Sales Overview</h6>
                            </div>


                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">

					<canvas id="bookingChart"></canvas>


                    </div>
                </div>
            </div> --}}

        </div><!--end row-->

        <div class="card radius-10">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Recent Booking</h6>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>B No</th>
                                    <th>B Date</th>
                                    <th>Customer</th>
                                    <th>Car</th>
                                    <th>Pick up Time</th>
                                    <th>Check In/Out</th>
                                    <th>Total Day</th>
                                    <th>Total Customer</th>
                                    <th>Status</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allData as $key => $item)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> <a href="{{ route('edit_booking', $item->id) }}"> {{ $item->code }}</a> </td>
                                        <td>{{ $item->created_at }} </td>
                                        <td> {{ $item['user']['name'] }}</td>
                                        <td>{{ $item['car']['type']['name'] }} </td>
                                        <td>{{ $item->pick_time }} </td>
                                        <td> <span class="badge bg-primary"> {{ $item->check_in }} </span>
                                            <span class="badge bg-warning text-dark"> {{ $item->check_out }} </span>
                                        </td>
                                        <td>{{ $item->total_night }} </td>
                                        <td> {{ $item->persion }}</td>

                                        <td>
                                            @if ($item->status == '1')
                                                <span class="text-success">Complete</span>
                                            @elseif ($item->status == '0' && $item->assign_cars->isNotEmpty())
                                                <span class="text-warning">On-going</span>
                                            @else
                                                <span class="text-danger">Pending</span>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>

	<script>
		var ctx = document.getElementById('bookingChart').getContext('2d');
		var bookings = @json($bookings);
	
		// Extract the required data from the bookings
		var labels = bookings.map(function(booking) {
			return booking.check_in; 
		});
	
		var data = bookings.map(function(booking) {
			return booking.total_night;
		});
	
		var bookingChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: labels,
				datasets: [{
					label: 'Booking Data',
					data: data,
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>
@endsection
