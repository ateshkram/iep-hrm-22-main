@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1>Disciplinary Cases </h1> --}}
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Disciplinary Desk</a>
                    </li>
                    <li class="breadcrumb-item active">Disciplinary Cases</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$state['warning']}}</h3>

                        <p>Total Warnings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-warning"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-primary">
                    <div class="inner">
                        <h3>{{$state['suspension']}}</h3>
                        <p> Total Suspensions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-hand"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$state['termination']}}</h3>

                        <p>Total Terminations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-close-round"></i>
                    </div>
                </div>
            </div>
            <!-- 
            <div class="col-lg-3 col-6">
                // small box //
                <div class="small-box bg-light">
                    <div class="inner">
                        <h3>10</h3>

                        <p> Total Pardons</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-flag"></i>
                    </div>
                </div>
            </div>
            // ./col // -->
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body ">
                        {{--Main Card Body--}}
                        <div class="form-group">
                            <hr>
                            {{--Main table content--}}
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="row" style="display: none;">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="checkboxPrimary1" checked>
                                            <label for="checkboxPrimary1"></label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="checkbox" checked id="checkboxDanger1" readonly>
                                            <label for="checkboxDanger1"></label>
                                        </div>
                                    </div>
                                    <!-- Small boxes (Stat box) -->

                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable1">
                                                <thead>
                                                <tr>
                                                    <th>Staff</th>
                                                    <th>Case Type</th>
                                                    <!--
                                                    <th>Offender</th>
                                                    <th>Subject</th>
                                                    -->
                                                    <th>Case Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i=0;$i<count($case);$i++)
                                                <tr>
                                                    <td>{{$case[$i]["staff"]["name"]}}</td>
                                                    <td>
                                                        <div class="form-group">            
                                                            {{$case[$i]["category"]["disciplinary_category_name"] }}                                            
                                                        </div>
                                                    </td>
                                                    <!--
                                                    <td>{{$case[$i]["staff"]["name"]}}</td>
                                                    
                                                    <td>{{$case[$i]["case_subject"]}}</td>
                                                    -->
                                                    <td>
                                                        <div class="form-group">                
                                                            {{$case[$i]["status"]["status_name"]}} 
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-info pull-right text-white text-bold" data-toggle="modal" data-target="#view{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> More </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                 <div class="modal fade" id="view{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">DC-{{$case[$i]["id"]}}: {{ $case[$i]["category"]["disciplinary_category_name"] }}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <dl class="row">
                                                                                        <dt class="col-sm-4">Information</dt>
                                                                                        <dd class="col-sm-8 bg-info">{{ $case[$i]["category"]["disciplinary_category_description"] }}</dd>
                                                                                        <dt class="col-sm-4">Case Subject</dt>
                                                                                        <dd class="col-sm-8"><b>{!! $case[$i]["case_subject"] !!}</b></dd>
                                                                                        <dt class="col-sm-4">Case Description</dt>
                                                                                        <dd class="col-sm-8">{!! $case[$i]["case_description"] !!}</dd>
                                                                                        <dt class="col-sm-4">Case Severity</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["case_severity"]}} </dd>
                                                                                        <dt class="col-sm-4">Case Status</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["status"]["status_name"]}} </dd>
                                                                                        <dt class="col-sm-4">Case Opened</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["case_created_date"]}} @ {{$case[$i]["case_created_time"]}} </dd>
                                                                                        @if($case[$i]["status"]["id"]==1)
                                                                                        <dt class="col-sm-4">Case Closed</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["case_closure_date"]}} @ {{$case[$i]["case_closure_time"]}} </dd>
                                                                                        @endif
                                                                                    </dl>
                                                                                </div>
                                                                            </div>

                                                                </div>
                                                                <div class="modal-footer justify-content-end">
                                                                    <button type="button" class="btn btn-default btn-flat elevation-1" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row (main row) -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        </div>
@endsection
