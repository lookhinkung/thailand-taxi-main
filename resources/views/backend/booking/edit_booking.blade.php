@extends('admin.admin_dashboard')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('admin')
<style>
    .large-text {
        font-size: 1.2rem; /* Adjust the size as needed */
    }
</style>

    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">



            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking No:</p>
                                <h4 class="my-1 text-info">{{ $editData->code }}</h4>

                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking Date:</p>
                                <h4 class="my-1 text-success">
                                    {{ \Carbon\Carbon::parse($editData->created_at)->format('Y-m_d') }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
								class='bx bxs-bar-chart-alt-2'></i>
						</div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Customers</p>
                                <h4 class="my-1 text-warning">{{ $editData->persion }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                    class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
				<div class="card radius-10 border-start border-0 border-3 border-danger">
                
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking Status </p>
                                <h4 class="my-1 text-warning">
                                    @if ($editData->status == '1')
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </h4>

                            </div>
                            
							<div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
								class='bx bxs-wallet'></i>
						</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="table">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Car Type</th>
                                        <th>Check In / Out Date</th>
                                        <th>Pick up Time</th>
                                        <th>Total Passenger</th>
                                        <th>Total Days</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $editData->car->type->name }}</td>
                                        <td>
                                            <span class="badge bg-primary"> {{ $editData->check_in }} </span>
                                             <br> <span class="badge bg-warning text-dark"> {{ $editData->check_out }}
                                            </span>
                                        </td>
                                        <td>{{ $editData->pick_time }}</td>
                                        <td>{{ $editData->persion }}</td>
                                        <td>{{ $editData->total_night }}</td>
                                    </tr>
                                </tbody>
                            </table>


			<div style="clear:both"></div>
			<div style="margin-top:40px; margin-bottom:20px">
				<a href="javascript::void(0)" class="btn btn-primary assign_car">Assign Car</a>
			</div>
			@php
				$assign_cars = App\Models\BookingCarList::with('car_number')->where('booking_id',$editData->id)->get();
			@endphp

			@if (count($assign_cars) > 0)
			
			<table class="table table-bordered">
				<tr>
					<th>Car Number</th>
					<th>Action</th>
				</tr>
				@foreach ($assign_cars as $assign_car)
					
				
				<tr>
					<td> {{$assign_car->car_number->car_no}} </td>
					<td>
						<a href=" {{route('assign_car_delete',$assign_car->id)}} " id="delete">Delete</a>
					</td>
				</tr>
				@endforeach
			</table>
			@else
			<div class="alert alert-danger text-center">
				Not Found Assign Car
			</div>
			@endif

                            <form action="{{ route('update.booking.status', $editData->id) }}" method="POST">
                                @csrf
                                <div class="row" style="margin-top:40px;">
                                    <div class="col-md-5">
                                        <label for="">Booking Status</label>
                                        <select name="status" id="input7" class="form-select">
                                            <option selected="">Select Status..</option>
                                            <option value="0" {{ $editData->status == 0 ? 'selected' : '' }}>Pending
                                            </option>
                                            <option value="1" {{ $editData->status == 1 ? 'selected' : '' }}>Complete
                                            </option>
                                        </select>
                                    </div>
									
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{route('download.invoice',$editData->id)}}" class="btn btn-warning px-3 radius-10"><i class="lni lni-download"></i>Invoice</a>
                                    </div>
                                </div>
                            </form>

                        </div>



                    </div>
                </div>
            </div>






            <div class="col-12 col-lg-4 ">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Manage Car and Date</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.booking', $editData->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="cold-md-12 mb-2">
                                    <label for="">CheckIn</label>
                                    <input type="date" required name="check_in" class="form-control"
                                        value="{{ $editData->check_in }}">
                                </div>

                                <div class="cold-md-12 mb-2">
                                    <label for="">CheckOut</label>
                                    <input type="date" required name="check_out" class="form-control"
                                        value="{{ $editData->check_out }}">
                                </div>
                                {{-- <div class="cold-md-12 mb-2">
                                    <label for="">Car No.</label>
                                    <input type="number" required name="car_numbers" class="form-control"
                                        value="{{ $editData->car_numbers }}">
                                </div> --}}
								{{-- <input type="hidden" name="available_room" id="available_room"  class="form-control"  > --}}
                                {{-- <div class="cold-md-12 mb-2">
							<label for="">Availability: <span class="text-success availability"></span></label>						
						</div> --}}
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Customer Information</h6>
                            </div>

                        </div>
                    </div>

                    <ul class="list-group list-group-flush large-text">
						<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
							Name <span class="badge bg-success rounded-pill">{{ $editData['user']['name'] }}</span>
						</li>
						<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
							Email <span class="badge bg-danger rounded-pill">{{ $editData['user']['email'] }}</span>
						</li>
						<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
							Phone <span class="badge bg-primary rounded-pill">{{ $editData['user']['phone'] }}</span>
						</li>
						<li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
							Nation <span class="badge bg-warning text-dark rounded-pill">{{ $editData->nationality }}</span>
						</li>
					</ul>
					
                </div>
                {{-- //end card radius-10 w-100 --}}

            </div>
        </div><!--end row-->

        {{-- Modal --}}
        <div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cars</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"></div>

                </div>
            </div>
        </div>
        {{-- Modal --}}
        <script>
            $(document).ready(function() {
                $(".assign_car").on('click', function() {
                    $.ajax({
                        url: "{{ route('assign_car', $editData->id) }}",
                        success: function(data) {
                            $('.myModal .modal-body').html(data);
                            $('.myModal').modal('show');
                        }
                    });
                    return false;
                });
            });
        </script>
    @endsection
