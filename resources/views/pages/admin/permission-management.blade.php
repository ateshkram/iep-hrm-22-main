@extends('layouts.app')

@section('content-header')
    @if(session()->has('success'))
        <input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
    @endif
    @if(session()->has('error'))
        <input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
    @endif
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Permission Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Permission Management</li>
                </ol>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function(){
            hiddensuccess=$("#hiddensuccesswcs").val();
            swal("Successful", hiddensuccess, "success");
        });

        $(document).ready(function(){
            hiddenerror=$("#hiddenerrorwcs").val();
            swal("Error Encounted", hiddenerror, "error");
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title font-weight-bold">Permission Management</h2>
                <a class="btn btn-info float-right text-white" href="#" data-toggle="modal" data-target="#new_permission">
                    <i class="fas fa-user-lock">
                    </i>
                    New Permission
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" style="display: none;">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary1" checked>
                        <label for="checkboxPrimary1">
                        </label>
                    </div>
                    <div class="icheck-danger d-inline">
                        <input type="checkbox" checked id="checkboxDanger1" readonly>
                        <label for="checkboxDanger1">
                        </label>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12" style="overflow-x: auto;">
                        <table class="table table-bordered table-striped dataTable1">
                            <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    <td>
                                        {{$permission->name}}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm sm" href="#" data-toggle="modal" data-target="#view_permission{{$permission->id}}">
                                            <i class="fas fa-eye">
                                            </i>
                                            View
                                        </a>

                                        <a class="btn btn-warning btn-sm sm" href="#" data-toggle="modal" data-target="#edit_permission{{$permission->id}}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete_permission{{$permission->id}}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="view_permission{{$permission->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-dialog-centered modal">
                                        <div class="modal-content">
                                            <form method="post" action="{{route('store-permission')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Permission Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="permission_name">Permission Name</label>
                                                        <input id="permission_name" type="text" name="permission_name" class="form-control" value="{{$permission->name}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="modal fade" id="edit_permission{{$permission->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-dialog-centered modal">
                                        <div class="modal-content">
                                            <form id="permission_form" method="post" action="{{route('update-permission',['id'=>$permission->id])}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Permission</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="permission_name">Permission Name</label>
                                                        <input id="permission_name" type="text" name="permission_name" class="form-control"  value="{{$permission->name}}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-info">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="modal fade" id="delete_permission{{$permission->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-dialog-centered modal">
                                        <div class="modal-content">
                                            <form method="post" action="{{route('delete-permission',['id' => $permission->id])}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Permission</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="permission_name">Are you sure you want to delete this permission?</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-info">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        Yes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="new_permission" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-centered modal">
                    <div class="modal-content">
                        <form id="permission_form" method="post" action="{{route('store-permission')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">New Permission</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="permission_name">Permission Name</label>
                                    <input id="permission_name" type="text" name="permission_name" class="form-control"  required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

@endsection

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#permission_form').validate({
                rules: {
                    permission_name: {
                        required: true
                    },
                },
                messages: {
                    permission_name: "Please Enter The Permission Name",
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
