@extends('layouts.app')@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Annual Leave History</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Leave</a></li>
                    <li class="breadcrumb-item active">Leave History</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Current Accrual</p>
                        <h3>{{$response["current_accrual"]}}</h3>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p> Carried Over</p>

                        <h3>{{$response["carry_over"]}}</h3>
                    </div>
                    <div class="icon pl-2">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Total Accrued</p>

                        <h3>{{$response["total_accrued"]}}</h3>
                    </div>
                    <div class="icon pl-2">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Days Committed</p>

                        <h3>{{$response["pending"]}}</h3>
                    </div>
                    <div class="icon pl-2">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>

            <div class="col">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Days Taken</p>

                        <h3>{{$response["taken"]}}</h3>
                    </div>
                    <div class="icon pl-2">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>

            <!-- ./col -->

            <div class="col">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <p>Total Available</p>
                        <h3>{{$response["total_available"]}}</h3>
                    </div>
                    <div class="icon pl-2">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
        </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        {{--Main Card Body--}}
                        <div class="form-group">
                            <h4> Annual Leave History</h4>
                        </div>
                        {{--Main table content--}}
                        <div class="form-group card-body">
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Begin Date </th>
                                    <th>End Date </th>
                                    <th>Leave Committed (Days)</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0;$i<count($annual_leave);$i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$annual_leave[$i]["start_date"]}}</td>
                                    <td>{{$annual_leave[$i]["end_date"]}}</td>
                                    <td>{{$commited[$i]}}</td>
                                    <td>{{$annual_leave[$i]["leavestatus"]["status_name"]}}</td>
                                    <td>
                                        <a href="#"  class="btn btn-info elevation-1 pull-right text-white text-bold" data-toggle="modal" data-target="#view{{$annual_leave[$i]["id"]}}">View </a>
                                    </td>
                                </tr>
                                     <div class="modal fade" id="view{{$annual_leave[$i]["id"]}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h4 class="modal-title float-left">Details </h4>
                                                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <dl class="row" >
                                                            <dt class="col-sm-4">Begin Date:</dt>
                                                            <dd class="col-sm-8">{{\Carbon\Carbon::parse($annual_leave[$i]["start_date"])->format('j F, Y')}}</dd>
                                                            <dt class="col-sm-4">End Date:</dt>
                                                            <dd class="col-sm-8">{{\Carbon\Carbon::parse($annual_leave[$i]["end_date"])->format('j F, Y')}}</dd>
                                                            <dt class="col-sm-4">Days Committed: </dt>
                                                            <dd class="col-sm-8">{{$commited[$i]}}</dd>
                                                            <dt class="col-sm-4">status</dt>
                                                            <dd class="col-sm-8">{{$annual_leave[$i]["leavestatus"]["status_name"]}}</dd>
                                                            <dt class="col-sm-4">Application Comment</dt>
                                                            <dd class="col-sm-8">{{$annual_leave[$i]["leave_application_comment"]}}</dd>
                                                            <dt class="col-sm-4">Supervisor's Review</dt>
                                                            <dd class="col-sm-8">{{$annual_leave[$i]["leave_application_review"]}}</dd>
                                                            <dt class="col-sm-4">Uploaded Document</dt>
                                                            <dd class="col-sm-8">hello</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                @endfor
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
@endsection
