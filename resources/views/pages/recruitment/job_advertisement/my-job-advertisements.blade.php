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
                <h1>My Job Advertisements</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">My Job Advertisements</li>
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
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title font-weight-bold">My Job Advertisements</h2>
{{--                <a class="btn btn-info float-right text-white" href="#" >--}}
{{--                    <i class="fas fa-briefcase-medical">--}}
{{--                    </i>--}}
{{--                    New Job Ad--}}
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
                                <th>#</th>
                                <th>Position Title</th>
                                <th>Grade</th>
                                <th>FTE</th>
                                <th>Opening Date</th>
                                <th>Closing Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_advertisements as $key=> $job_advertisement)
                                <tr>
                                    <td>{{$job_advertisement->position_number}}</td>
                                    <td>{{$job_advertisement->position_title}}</td>
                                    <td>{{$job_advertisement->grade}}</td>
                                    <td>{{$job_advertisement->FTE}}</td>
                                    <td>{{$job_advertisement->opening_date}}</td>
                                    <td>{{$job_advertisement->closing_date}}</td>
                                    <td>
                                        <div class="col">
                                            {{$job_advertisement->status}}
                                        </div>
                                        <div class="col">
                                            Total Applications: {{count($job_advertisement->jobApplications)}}
                                        </div>

                                    </td>
                                    <td>
                                        <div class="btn-group-vertical">
                                            <div class="p-1">
                                                <a href="{{route('show-job-advertisement', ['id'=>$job_advertisement->id])}}"  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-folder"></i> View </a>

                                            </div>
                                            <div class="p-1">
                                                <a href="{{route('edit-job-advertisement',['id'=>$job_advertisement->id])}}"  class="btn btn-xs btn-warning pull-right text-white text-bold"> <i class="fa fa-edit"></i> Edit </a>

                                            </div>
                                            @if($job_advertisement->status == 'Published')
                                                <div class="p-1">
                                                    <a href="{{route('unpublish-job-advertisement',['id'=>$job_advertisement->id])}}"
                                                       class="btn btn-xs btn-danger pull-right text-white text-bold"
                                                       onclick="event.preventDefault(); document.getElementById('un-publish').submit();">
                                                        <i class="fa fa-eye-slash"></i>
                                                        UnPublish
                                                    </a>
                                                    <form id="un-publish" action="{{route('unpublish-job-advertisement',['id'=>$job_advertisement->id])}}" method="POST" class="d-none">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                    </form>

                                                </div>
                                            @else
                                                <div class="p-1">

                                                    <a href="{{route('publish-job-advertisement',['id'=>$job_advertisement->id])}}"
                                                       class="btn btn-xs btn-success pull-right text-white text-bold"
                                                       onclick="event.preventDefault(); document.getElementById('publish').submit();">
                                                        <i class="fa fa-eye"></i>
                                                        Publish
                                                    </a>
                                                    <form id="publish" action="{{route('publish-job-advertisement',['id'=>$job_advertisement->id])}}" method="POST" class="d-none">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                    </form>
                                                </div>
                                            @endif



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
