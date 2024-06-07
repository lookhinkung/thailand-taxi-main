@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Car List</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Car List</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-4">
            


                <form method="POST" action="{{route('store.car.list')}}" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label for="cartype_id" class="form-label">Car Type</label>
                        <select name="car_id" id="car_id"  class="form-select">
                            <option selected="">Select Car Type</option>
                            @foreach ($cartype as $item)
                            <option value="{{$item->car->id}}"{{ collect(old('cartype_id'))
                            ->contains($item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                            @endforeach
                            
                        </select>
                        <input type="hidden" name="available_car" id="available_car" class="form-control">
                        {{-- <div class="mt-2">
                            <label for="">Availability <span class="text-success" availability></span></label>
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        <label for="input2" class="form-label">Check In</label>
                        <input type="date" name="check_in" id="check_in" class="form-control" id="input2">
                    </div>
                    <div class="col-md-4">
                        <label for="input3" class="form-label">Check Out</label>
                        <input type="date" name="check_out" id="check_out" class="form-control" id="input3">
                    </div>
                    <div class="col-md-4">
                        <label for="input4" class="form-label">Guest</label>
                        <input type="number" class="form-control" id="number_of_person" name="number_of_person">
                    </div>
                    <div class="col-md-4">
                        <label for="input4" class="form-label">Pick up Time</label>
                        <input type="time" class="form-control datetimepicker5"  name="pick_time">
                    </div>

                    <h3 class="mt-3 mb-5 text-center">Customer Information</h3>

                    <div class="col-md-3">
                        <label for="input5" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="input5" value="{{old('name')}}">
                    </div>
                    <div class="col-md-3">
                        <label for="input6" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="input6" value="{{old('email')}}">
                    </div>
                    <div class="col-md-3">
                        <label for="input6" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="input6" value="{{old('phone')}}">
                    </div>
                    <div class="col-md-3">
                        <label for="input6" class="form-label">Nationality</label>
                        <input type="text" name="nationality" class="form-control" id="input6" value="{{old('nationality')}}">
                    </div>
                    
                    
                    
                    
                    <div class="col-md-12">
                        <label for="input11" class="form-label">Message to Us</label>
                        <textarea class="form-control" name="msg" id="input11" value="{{old('msg')}}" rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">Submit</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $("#car_id").on('change', function (){
            $("#check_in").val('');
            $("#check_out").val('');
            $(".availability").text(0);
            $("#available_car").val(0); 
        });
        $("#check_out").on('change', function() {
            getAvaility();
        });
    });
    function getAvaility(){
        var check_in = $('#check_in').val();
        var check_out = $('#check_out').val();
        var car_id = $("#car_id").val();
        var startDate = new Date(check_in);
        var endDate = new Date(check_out); 
        if (startDate > endDate) {
            alert('Invalid Date');
            $("#check_out").val('');
            return false;
        }
        if (check_in != '' && check_out != '' && car_id != '') {
        $.ajax({
        url: "{{ route('check_car_availability') }}",
        data: {car_id:car_id, check_in:check_in, check_out:check_out},
        success: function(data){
            $(".availability").text(data['available_car']);
            $("#available_car").val(data['available_car']);
         }
        }); 
            
        
      }else{
        alert('Field must be not empty')
      } 


    }
     
</script>
@endsection