@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>

    <style>
        .large-text {
            font-size: 0.85rem; /* Adjust the size as needed */
        }
    </style>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Car List</li>
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
        <h6 class="mb-0 text-uppercase">All Car List</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>Car Type</th>
                                <th>Car Number</th>
                                <th>B Status</th>
                                <th>In/Out Date</th>
                                <th>Booking No</th>
                                <th>Customer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($car_number_list as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ @$item->name }} </td>
                                    <td>{{ $item->car_no }}</td>
                                    <td>@if ($item->booking_id != '')
                                            @if ($item->booking_status == 1)
                                                <span class="badge bg-warning large-text">Pending</span>
                                                @else
                                                <span class="badge bg-danger large-text">Booked</span>
                                            @endif
                                            @else
                                            <span class="badge bg-success large-text">Available</span>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($item->booking_id != '')
                                            <span class="badge rounded-pill bg-secondary large-text">
                                                {{date('d-m-Y',strtotime($item->check_in))}}
                                            </span>
                                            to
                                            <span class="badge rounded-pill bg-info text-dark large-text">
                                                {{date('d-m-Y',strtotime($item->check_out))}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->booking_id != '')
                                            {{$item->booking_no}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->booking_id != '')
                                            {{$item->customer_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'Active')
                                        <span class="badge bg-success large-text">Published</span>
                                            @else
                                            <span class="badge bg-danger large-text">InActive</span>
                                        @endif
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
