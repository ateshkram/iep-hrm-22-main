@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        @if(session()->has('success'))
            <input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
        @endif
        @if(session()->has('error'))
            <input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Management</li>
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
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#hrms_users" data-toggle="tab">HRMS Users</a></li>
                            <li class="nav-item"><a class="nav-link" href="#job_portal_users" data-toggle="tab">Job Portal Users</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="hrms_users">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h2 class="card-title font-weight-bold">HRMS Users</h2>
                                                    <a class="btn btn-info float-right text-white" href="#" data-toggle="modal" data-target="#new_user">
                                                        <i class="fas fa-user-plus">
                                                        </i>
                                                        New User
                                                    </a>

                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <table class="table table-bordered table-hover dataTable1">
                                                        <thead>
                                                        <tr>
                                                            <th>Username</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($users as $key => $user)
                                                            <tr>
                                                                <td>
                                                                    {{$user->username}}
                                                                </td>
                                                                <td>
                                                                    {{$user->name}}
                                                                </td>
                                                                <td>
                                                                    {{$user->email}}
                                                                </td>
                                                                <td>
                                                                    <div class="col">
                                                                        <span class="badge bg-warning">{{$user->roles->first()->name}}</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="badge bg-teal">Total Permissions: {{count($user->getAllPermissions())}}</span>
                                                                    </div>
                                                                </td>
                                                                <td >
                                                                    <a class="btn btn-primary btn-sm sm" href="#" data-toggle="modal" data-target="#modal-default">
                                                                        <i class="fas fa-eye">
                                                                        </i>
                                                                        View
                                                                    </a>

                                                                    <a class="btn btn-info btn-sm sm" href="#" data-toggle="modal" data-target="#assign_new_role{{$user->id}}">
                                                                        <i class="fas fa-user-shield">
                                                                        </i>
                                                                        Assign Role
                                                                    </a>
                                                                    <a class="btn btn-success btn-sm sm" href="#" data-toggle="modal" data-target="#assign_extra_permissions{{$user->id}}">
                                                                        <i class="fas fa-user-lock">
                                                                        </i>
                                                                        Assign Extra Permissions
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm sm" href="#" data-toggle="modal" data-target="#delete_user{{$user->id}}">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade" id="assign_new_role{{$user->id}}" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog modal-dialog-centered modal">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('assign-new-role',['id' => $user->id])}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Assign Role</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group ">
                                                                                    <label for="role{{$user->id}}">Role</label>
                                                                                    <select id="role{{$user->id}}" name="role" class="select2bs4" data-placeholder="Select a role"
                                                                                            style="width: 100%;" required>
                                                                                        <option value="{{$user->roles->first()->name}}" selected>{{$user->roles->first()->name}}</option>
                                                                                        @foreach($roles->diff($user->roles) as $role)
                                                                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                                <button type="submit" class="btn btn-info">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('PUT') }}
                                                                                    Assign Role
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <!-- /.modal-content -->
                                                                </div>
                                                                <!-- /.modal-dialog -->
                                                            </div>
                                                            <!-- /.modal -->
                                                            <div class="modal fade" id="assign_extra_permissions{{$user->id}}" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog model-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('assign-extra-permissions',['id' => $user->id])}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Assign Extra Permissions</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group ">
                                                                                    <label for="role_name{{$user->id}}">Role</label>
                                                                                    <input id="role_name{{$user->id}}" type="text" name="role_name" class="form-control"  value="{{$user->roles->first()->name}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="role_permission{{$user->id}}">Role Permissions</label>
                                                                                    <select id="role_permission{{$user->id}}" name="role_permissions[]" class="select2bs4" multiple="multiple" data-placeholder="Select a permission" disabled
                                                                                            style="width: 100%;">
                                                                                        @foreach($user->getPermissionsViaRoles() as $selected_permission)
                                                                                            <option value="{{$selected_permission->name}}" selected>{{$selected_permission->name}}</option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="extra_permission{{$user->id}}">Extra Permissions</label>
                                                                                    <select id="extra_permission{{$user->id}}" name="extra_permissions[]" class="select2bs4" multiple="multiple" data-placeholder="Select a permission"
                                                                                            style="width: 100%;" required>
                                                                                        @foreach($user->getDirectPermissions() as $selected_permission)
                                                                                            <option value="{{$selected_permission->name}}" selected>{{$selected_permission->name}}</option>
                                                                                        @endforeach
                                                                                        @foreach($permissions->diff($user->getAllPermissions()) as $permission)
                                                                                            <option value="{{$permission->name}}" >{{$permission->name}}</option>
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
                                                            <div class="modal fade" id="delete_user{{$user->id}}" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog modal-dialog-centered modal">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('delete-hrms-user',['id' => $user->id])}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Delete HRM User</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group ">
                                                                                    <label for="permission_name">Are you sure you want to delete this user?</label>
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
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="job_portal_users">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h2 class="card-title font-weight-bold">Job Portal Users</h2>
                                                    <a class="btn btn-info float-right text-white" href="#" data-toggle="modal" data-target="#new_portal_user">
                                                        <i class="fas fa-user-plus">
                                                        </i>
                                                        New Portal User
                                                    </a>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <table  class="table table-bordered table-striped dataTable1">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
{{--                                                            <th>Username</th>--}}
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Total Applications</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($candidates as $key => $candidate)
                                                            <tr>
                                                                <td>
                                                                    {{$candidate->id}}
                                                                </td>
{{--                                                                <td>--}}
{{--                                                                    {{$candidate->username}}--}}
{{--                                                                </td>--}}
                                                                <td>
                                                                    {{$candidate->name}}
                                                                </td>
                                                                <td>
                                                                    {{$candidate->email}}
                                                                </td>
                                                                <td>
                                                                    {{count($candidate->jobApplications)}}
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary btn-sm sm" href="#">
                                                                        <i class="fas fa-eye">
                                                                        </i>
                                                                        View
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm sm" href="#" data-toggle="modal" data-target="#delete_portal_user{{$candidate->id}}">
                                                                        <i class="fas fa-trash">
                                                                        </i>
                                                                        Delete
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <div class="modal fade" id="delete_portal_user{{$candidate->id}}" data-backdrop="static" data-keyboard="false">
                                                                <div class="modal-dialog modal-dialog-centered modal">
                                                                    <div class="modal-content">
                                                                        <form method="post" action="{{route('delete-portal-user',['id' => $candidate->id])}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Delete Job Portal User</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group ">
                                                                                    <label for="permission_name">Are you sure you want to delete this job portal user?</label>
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
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    <div class="modal fade" id="new_user">
                        <div class="modal-dialog modal-dialog-centered modal">
                            <div class="modal-content">
                                <form method="post" action="{{route('store-hrms-user')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">New User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group ">
                                            <label for="name">Full Name</label>
                                            <input id="name" type="text" name="name" class="form-control"  required>
                                        </div>
                                        <div class="form-group ">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" name="username" class="form-control" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group ">
                                            <label for="role">Role</label>
                                            <select id="role" name="role" class="select2bs4" data-placeholder="Select a role"
                                                    style="width: 100%;" required>
                                                <option value="null" selected>--</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade" id="new_portal_user">
                        <div class="modal-dialog modal-dialog-centered modal">
                            <div class="modal-content ">
                                <form method="post" action="{{route('store-portal-user')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Portal User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group ">
                                            <label for="name">Full Name</label>
                                            <input id="name" type="text" name="name" class="form-control" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" required >
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
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
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->

@endsection
