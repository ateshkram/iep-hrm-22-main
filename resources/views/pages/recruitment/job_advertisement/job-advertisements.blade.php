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
                <h1>Job Advertisements</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Job Advertisements</li>
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
                <h2 class="card-title font-weight-bold">Job Advertisements</h2>
{{--                <a class="btn btn-info float-right text-white" href="{{route('create-job-advertisement')}}" >--}}
{{--                    <i class="fas fa-briefcase-medical">--}}
{{--                    </i>--}}
{{--                    Create Job Ad--}}
{{--                </a>--}}
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
                                <th data-orderable="false">#</th>
                                <th>Position Title</th>
                                <th>Department</th>
                                <th>Total Applications</th>
                                <th>Total Pending Applications</th>
                                <th>Status</th>
                                <th>Reviewer</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_ads as $key=> $job_advertisement)
                                <tr>
                                    <td>{{$job_advertisement->position_number}}</td>
                                    <td>{{$job_advertisement->position_title}}</td>
                                    <td>{{$job_advertisement->department->department_name}}</td>
                                    <td>
                                        {{count($job_advertisement->jobApplications)}}
                                    </td>
                                    <td>
                                        {{count($job_advertisement->jobApplications->where('status','Applied'))}}
                                    </td>
                                    <td>
                                        <div class="col">
                                            {{$job_advertisement->status}}
                                        </div>
                                    </td>
                                    <td>{{$job_advertisement->reviewer->name}}</td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <div class="p-1">
                                                <a href="{{route('show-job-advertisement', ['id'=>$job_advertisement->id])}}"  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-eye"></i> View </a>

                                            </div>
                                            <div class="p-1">
                                                <a href="{{route('edit-job-advertisement',['id'=>$job_advertisement->id])}}"  class="btn btn-xs btn-warning pull-right text-white text-bold"> <i class="fa fa-edit"></i> Edit </a>

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
