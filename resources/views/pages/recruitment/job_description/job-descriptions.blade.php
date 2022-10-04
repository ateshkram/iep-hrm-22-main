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
                <h1>Job Descriptions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Job Descriptions</li>
                </ol>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function(){
            // document.getElementById('newscheckbox').attr="checked";
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
                <h2 class="card-title font-weight-bold">Job Descriptions</h2>
                <a class="btn btn-info float-right text-white" href="{{route('create-job-description')}}" >
                    <i class="fas fa-folder-plus">
                    </i>
                    New Job Description
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
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Skills</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_descriptions as $key=> $job_description)
                                <tr>
                                    <td>
                                        {{$job_description->id}}
                                    </td>
                                    <td>
                                        {{$job_description->job_title}}
                                    </td>
                                    <td>
                                        @foreach($job_description->skills as $skill)
                                            <span class="badge bg-teal">
                                                {{$skill->skill_name}}
                                            </span>

                                        @endforeach
                                    </td>

                                    <td>
                                        <div class="btn-group-vertical">
                                            <div class="p-1">
                                                <a href="{{route('show-job-description',['id'=>$job_description->id])}}"  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-eye"></i> View </a>

                                            </div>
                                            <div class="p-1">
                                                <a href="{{route('edit-job-description',['id' => $job_description->id])}}" class="btn btn-xs btn-warning pull-right text-white text-bold"> <i class="fas fa-edit"></i> Edit</a>

                                            </div>
                                            <div class="p-1">
                                                <a href="{{route('create-job-advertisement',['job_description' => $job_description])}}" class="btn btn-xs btn-info pull-right text-white text-bold">
                                                    <i class="fas fa-briefcase-medical">
                                                    </i>
                                                    New Job Ad
                                                </a>

                                            </div>
                                            <div class="p-1">
                                                <a class="btn btn-xs btn-danger pull-right text-white text-bold"
                                                   href="#"
                                                ><i class="fas fa-trash-alt"></i>Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
