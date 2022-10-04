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
                <h1>Role Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Role Management</li>
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
                <h2 class="card-title font-weight-bold">Role Management</h2>
                <a class="btn btn-info float-right text-white" href="#" data-toggle="modal" data-target="#new_role">
                    <i class="fas fa-user-shield">
                    </i>
                    New Role
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
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>
                                        {{$role->name}}
                                    </td>
                                    <td>
                                        @foreach($role->permissions as $key=> $permission)
                                                <span class="badge bg-teal">
                                                    {{$permission->name}}
                                                </span>

                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="p-1">
                                            <a class="btn btn-primary btn-sm sm" href="#" data-toggle="modal" data-target="#view_role{{$role->id}}">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                        </div>
                                        <div class="p-1">
                                            <a class="btn btn-warning btn-sm sm" href="#" data-toggle="modal" data-target="#edit_role{{$role->id}}">
                                                <i class="fas fa-edit">
                                                </i>
                                            </a>
                                        </div>
                                        <div class="p-1">
                                            <a class="btn btn-danger btn-sm sm" href="#" data-toggle="modal" data-target="#delete_role{{$role->id}}">
                                                <i class="fas fa-trash">
                                                </i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="view_role{{$role->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog model-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Role Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group ">
                                                    <label for="role_name">Role Name</label>
                                                    <input id="role_name" type="text" name="role_name" class="form-control"  value="{{$role->name}}" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col">
                                                        <div class="col">
                                                            <label >Permissions</label>
                                                        </div>
                                                        <div class="col">
                                                            @foreach($role->permissions as $key=> $permission)
                                                                <span class="badge bg-teal">
                                                                    {{$permission->name}}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <div class="modal fade" id="edit_role{{$role->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog model-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form method="post" action="{{route('update-role',['id' => $role->id])}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Role</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="role_name{{$role->id}}">Role Name</label>
                                                        <input id="role_name{{$role->id}}" type="text" name="role_name" class="form-control"  value="{{$role->name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role_permission{{$role->id}}">Role Permissions</label>
                                                        <select id="role_permission{{$role->id}}" name="role_permissions[]" class="select2bs4" multiple="multiple" data-placeholder="Select a permission"
                                                                style="width: 100%;" required>
                                                            @foreach($role->permissions as $selected_permission)
                                                                <option value="{{$selected_permission->name}}" selected>{{$selected_permission->name}}</option>
                                                            @endforeach
                                                            @foreach($permissions->diff($role->permissions) as $permission)
                                                                <option value="{{$permission->name}}">{{$permission->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-info">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <div class="modal fade" id="delete_role{{$role->id}}" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog model-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form method="post" action="{{route('delete-role',['id' => $role->id])}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete Role</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group ">
                                                        <label for="role_name">Are you sure you want to delete this role?</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-info">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        Yes</button>
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

            <div class="modal fade" id="new_role" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog model-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form method="post" action="{{route('store-role')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title">New Role</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group ">
                                    <label for="role_name">Role Name</label>
                                    <input id="role_name" type="text" name="role_name" class="form-control" required >
                                </div>
                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <select id="permissions" name="permissions[]" class="select2bs4" multiple="multiple" data-placeholder="Select a permission"
                                            style="width: 100%;" required>

                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                                        @endforeach
                                    </select>
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
