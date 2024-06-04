@extends('admin.admin_dashboard')
@section('admin') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
			 
				<div class="container">
					<div class="main-body">
						<div class="row">
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Manage car </div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false" tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                        </div>
                        <div class="tab-title">Car Number</div>
                    </div>
                </a>
            </li>
            
        </ul>
        <div class="tab-content py-3">
            <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
              
                <div class="col-xl-12 mx-auto">
						
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Update car </h5>
    <form class="row g-3" action="{{ route('update.car',$editData->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <div class="col-md-3">
            <label for="input1" class="form-label">Car Type Name </label>
            <input type="text" name="cartype_id" class="form-control" id="input1" 
            value="{{ $editData['type']['name'] }}" >
        </div> --}}
        <div class="col-md-3">
            <label for="input2" class="form-label">Total Passenger</label>
            <input type="text" name="total_passenger" class="form-control"
                id="input2" value="{{ $editData->total_passenger }}">
        </div>
        <div class="col-md-9">
            <label for="input2" class="form-label">Car Capacity</label>
            <input type="text" name="car_capacity" class="form-control"
                id="input2" value="{{ $editData->car_capacity }}">
        </div>
        
        <div class="col-md-6">
            <label for="input3" class="form-label">Main Image </label>
            <input type="file" name="image" class="form-control" id="image"  >
            <img id="showImage" src="{{ (!empty($editData->image)) ? 
            url('upload/carimg/'.$editData->image) : url('upload/no_image.jpg') }}" 
            alt="Admin" class="bg-primary" width="70" height="50"> 
        </div>
        <div class="col-md-6">
            <label for="input4" class="form-label">Gallery Image </label>
            <input type="file" name="multi_img[]" class="form-control" multiple id="multiImg" accept="image/*" >
            @foreach ($multiimgs as $item)
            <img src="{{ (!empty($item->multi_img)) ? url('upload/carimg/multi_img/'.$item->multi_img) : url('upload/no_image.jpg') }}" alt="Admin" class="bg-primary" width="70" height="50"> 
              <a href="{{ route('multi.image.delete',$item->id) }}"><i class="lni lni-close"></i> </a>  
            @endforeach
            <div class="row" id="preview_img"></div>
        </div>
        
  
        <div class="col-md-12">
            <label for="input11" class="form-label">Short Description </label>
            <textarea name="short_desc" class="form-control" id="input11" placeholder="Address ..." rows="3">{{ $editData->short_desc }}</textarea>
        </div>
        <div class="col-md-12">
            <label for="input11" class="form-label"> Description </label>
            <textarea name="description" class="form-control" id="myeditorinstance" >{!! $editData->description !!}</textarea>
        </div>
        

           
 
 
        <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" class="btn btn-primary px-4">Save Changes</button> 
            </div>
        </div>
    </form>
                        </div>
                    </div>
 
                </div>
            </div>
             {{-- // End primaryhome --}}







            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                 <div class="card">
                    <div class="card-body">
                        <a class="card-title btn btn-primary float-right" onclick="addCarNo()" id="addCarNo">
                            <i class="lni lni-plus">Add New</i>
                        </a>
        <div class="carnoHide" id="carnoHide">
            <form action="{{route('store.car.no',$editData->id)}}" method="POST">
                @csrf

                <input type="hidden" name="car_type_id" value="{{$editData->cartype_id}}">

                <div class="row">
                <div class="col-md-4">
                    <label for="input2" class="form-label">Car No. </label>
                    <input type="text" name="car_no" class="form-control" id="input2" >
                </div>

                <div class="col-md-4">
                    <label for="input7" class="form-label">Status </label>
                    <select name="status" id="input7" class="form-select">
                        <option selected="">Select Status...</option>
                        <option value="Active">Active </option>
                        <option value="Inactive">Inactive  </option>

                    </select>
                </div> 

                <div class="col-md-4">

                    <button type="submit" class="btn btn-success" style="margin-top: 28px;">Save</button>

                </div>


            </div>

            </form>

        </div>
        <table class="table mb-0 table-striped" id="carview">
            <thead>
                <tr>
                    <th scope="col">Car No.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allcarNo as $item)
                    
                
                <tr>
                    <td>{{$item->car_no}}</td>
                    <td>{{$item->status}}</td>
                    <td>
                        <a href="{{route('edit.carno',$item->id)}}" class="btn btn-warning px-3 radius-30">Edit</a>
                        <a href="{{route('delete.carno',$item->id)}}" class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>






                    </div>
                    </div> 






            
            </div> 
            {{-- // end PrimaryProfile --}}



        </div>
    </div>
</div>
						 
 
						</div>
					</div>
				</div>
 </div>
 
        <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        </script>   
        
        
        <!--------===Show MultiImage ========------->
<script>
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
 </script>
<!--------===Start Car Number add ========------->

 <script>
    $('#carnoHide').hide();
    $('#carview').show();
    function addCarNo(){
        $('#carnoHide').show();
        $('#carview').hide();
        $('#addCarNo').hide();
    }
</script>









<!--------===End Car Number Add ========------->
@endsection