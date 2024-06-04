@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Team</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Team</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                
    <div class="col-lg-8">
        <div class="card">
            <form action="{{route('team.store')}}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf

            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Name</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                        <input type="text" name="name" class="form-control" />
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Position</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                        <input type="text" name='position' class="form-control" />
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Position</h6>
                    </div>
                    {{-- <div class="form-group col-sm-9 text-secondary">
                        <select name="position" class="form-control custom-dropdown">
                            <option value="" disabled selected>Select your position</option>
                            <option value="manager">Manager</option>
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                            <option value="analyst">Analyst</option>
                            <option value="other">Other</option>
                        </select>
                    </div> --}}
                    <div class="form-group col-sm-9 text-secondary">
                        <select name="position" class="form-select" id="inputGroupSelect02" fdprocessedid="v9vmnj">
                            <option selected="">Choose...</option>
                            <option value="1">Ceo</option>
                            <option value="2">Driver</option>
                            <option value="3">Coordinator</option>
                        </select>
                        
                    </div>
                </div>
                
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Facebook</h6>
                    </div>
                    <div class="form-group col-sm-9 text-secondary">
                        <input type="text" name='facebook' class="form-control"/>
                    </div>
                </div>
                
                
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Upload photo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input class="form-control" name="image" type="file" id="image">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Image</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <img id="showImage" src="{{url ('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                    </div>
                </div>
                
            </div>
        </form>
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
        <script type="text/javascript">
            $(document).ready(function (){
                $('#myForm').validate({
                    rules: {
                        name: {
                            required : true,
                        }, 
                        position: {
                            required : true,
                        }, 
                        facebook: {
                            required : true,
                        }, 
                        
                    },
                    messages :{
                        name: {
                            required : 'Please Enter Name',
                        },
                        position: {
                            required : 'Please Enter Position',
                        },
                        facebook: {
                            required : 'Please Enter Facebook',
                        },
                         
                         
        
                    },
                    errorElement : 'span', 
                    errorPlacement: function (error,element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight : function(element, errorClass, validClass){
                        $(element).addClass('is-invalid');
                    },
                    unhighlight : function(element, errorClass, validClass){
                        $(element).removeClass('is-invalid');
                    },
                });
            });
            
        </script>


@endsection