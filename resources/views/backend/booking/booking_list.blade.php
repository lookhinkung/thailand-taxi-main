@extends('admin.admin_dashboard')
@section('admin')
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
                    <a href="{{ route('add.team') }}" class="btn btn-primary px-5">Add Booking</a>

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
                                <th>Check In/Out</th>
                                <th>Total Day</th>
                                <th>Guest</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $key => $item)
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> <a href="{{ route('edit_booking',$item->id)}}"> {{$item->code}}</a> </td>
                                    <td>{{$item->created_at}} </td>
                                    <td> {{$item['user']['name']}}</td>
                                    <td>{{$item['car']['type']['name']}} </td>
                                    <td> <span class="badge bg-primary"> {{$item->check_in}} </span>
                                    / <br> <span class="badge bg-warning text-dark"> {{$item->check_out}} </span></td>
                                    <td>{{$item->total_night}}  </td>
                                    <td> {{$item->persion}}</td>
                                    <td>{{$item->status == '1'}} </td>
                                    <td> {{$item->total_night}}</td>
                                    <td> </td>

                                    <td>
                                        <a href="{{ route('delete.team', $item->id) }}" class="btn btn-danger px-3 radius-30"
                                            id="delete">Delete</a>
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
