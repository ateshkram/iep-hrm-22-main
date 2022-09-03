@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>My Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="https://image.winudf.com/v2/image1/dXNwLm1sZWFybi51c3Btb2JpbGVhcHBfaWNvbl8xNTU0MjA5MTk0XzAxNg/icon.png?w=170&fakeurl=1"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">Role: {{ Auth::user()->roles->first()->name }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Total Permissions</b> <a class="badge bg-teal float-right">{{count(Auth::user()->roles->first()->permissions)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Position Title</b> <a class="badge bg-teal float-right">{{Auth::user()->position}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Section</b> <a class="badge bg-teal float-right">{{Auth::user()->section}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Department</b> <a class="badge bg-teal float-right">{{Auth::user()->department}}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-info card-outline elevation-3">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal" data-toggle="tab">Personal Information</a></li>
                            <li class="nav-item"><a class="nav-link " href="#leave" data-toggle="tab">Leave Information</a></li>
                            <li class="nav-item"><a class="nav-link " href="#contract" data-toggle="tab">Contract Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab">Contact Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change Password</a></li>
                            <li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab">Update Profile Picture</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal">
                                <form id="quickForm"
                                      enctype="multipart/form-data"
                                      action="#"
                                      method="post"
                                >
                                @csrf
                                <!-- jquery validation -->
                                    <div class="card card-teal card-outline elevation-3">
                                        <div class="card-header">


                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="job_title">Job Title</label>
                                                <div class="col-sm-auto">
                                                    <input type="text"
                                                           class="form-control"
                                                           id="job_title"
                                                           name="job_title"
                                                           required
                                                           placeholder="Specify Job Title"
                                                           value="{{Auth::user()->name}}"
                                                    >
                                                </div>
                                            </div>

                                        <div class="card-footer">
                                            <button type="submit" value="submit" class="btn btn-primary">
                                                @if($edit)
                                                    {{ csrf_field() }}
                                                    {{ method_field('PUT') }}
                                                @endif
                                                Save
                                            </button>
                                            <a class="btn btn-primary" href="{{route('all-job-descriptions')}}">Cancel</a>
                                        </div>
                                    </div>
                                    </div>

                                </form>
                                <!-- /.row -->
                                <div class="card">
                                    <div class="card-body">

                                    </div>
                                    <div class="card-footer">

                                    </div>

                                </div>


                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="leave">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="contract">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="password">

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="profile">

                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="contact">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
