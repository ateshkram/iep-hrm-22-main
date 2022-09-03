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
                <h1>Job Applications</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Job Applications</li>
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
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Job Applications</span>
                        <span class="info-box-number">
                        1
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Current Job Applications</span>
                        <span class="info-box-number">
                            20
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Closed Job Applications</span>
                        <span class="info-box-number">
                            20
                        </span>


                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Rejected Job Applications</span>
                        <span class="info-box-number">
                            20
                        </span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="card-title">Job Application List</h3>
                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
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
                                <th>Applicant Name</th>
                                <th>Applicant Summary</th>
                                <th>Reviewer</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_applications as $key => $job_application)
                                <tr>
                                    <td>
                                        {{$job_application->application_number}}
                                    </td>
                                    <td>
                                        {{$job_application->jobAdvertisement->position_title}}
                                    </td>
                                    <td>
                                        {{$job_application->candidate->name}}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{$job_application->reviewer->name}}
                                    </td>
                                    <td>
                                        {{$job_application->status}}
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
