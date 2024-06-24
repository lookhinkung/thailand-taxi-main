@extends('admin.admin_dashboard')
@section('admin')
    <style>
        .large-text {
            font-size: 0.85rem;
            /* Adjust the size as needed */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Booking</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.car.list') }}" class="btn btn-primary px-5">Add Booking</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">All Booking</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                <th>Pax</th>
                                <th>Status</th>
                                <th>Action</th>

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
                                        <br> <span class="badge bg-warning text-dark"> {{ $item->check_out }} </span>
                                    </td>
                                    <td>{{ $item->total_night }} </td>
                                    <td> {{ $item->persion }}</td>


                                    <td>
                                        @if ($item->status == '1')
                                            <span class="badge bg-info text-dark large-text">Complete</span>
                                        @elseif ($item->status == '2')
                                            <span class="badge bg-danger text-dark large-text">Declined</span>
                                        @elseif ($item->status == '0' && $item->assign_cars->isNotEmpty())
                                            <span class="badge bg-success text-dark large-text">On-going</span>
                                        @else
                                            <span class="badge bg-warning text-dark large-text">Pending</span>
                                        @endif
                                    </td>












                                    <td>
                                        <a href="{{ route('delete.booking', $item->id) }}"
                                            class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr />
    </div>
@endsection
