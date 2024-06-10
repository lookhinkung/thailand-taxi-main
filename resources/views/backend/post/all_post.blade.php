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
                        <li class="breadcrumb-item active" aria-current="page">All Post</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.blog.post') }}" class="btn btn-primary px-5">Add Post</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">All Post</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>Post Title</th>
                                <th>Blog Category</th>
                                <th>Post Image</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->post_title }}</td>
                                    <td>{{ $item['blog']['category_name'] }}</td>
                                    <td> <img src="{{ asset($item->post_image) }}" alt=""
                                            style="width:70px; height:40px;"> </td>

                                    <td>
                                        <a href="{{ route('edit.blog.post', $item->id) }}"
                                            class="btn btn-warning px-3 radius-30">Edit</a>
                                        <a href="{{ route('delete.blog.post', $item->id) }}"
                                            class="btn btn-danger px-3 radius-30" id="delete">Delete</a>
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
