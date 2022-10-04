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
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>1</h3>

                        <p>Total Cases Open</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-folder-open"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        <h3>1</h3>
                        <p> Total Cases Closed</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-exit"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>1</h3>

                        <p>Total Cases Pending</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clock"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>10</h3>

                        <p> Total Cases Resolved</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-done"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body ">
                        {{--Main Card Body--}}
                        <div class="form-group">
                            <h4>
                                 Disciplinary Case Records
                                <button type="button" class="btn btn-info btn-flat float-right elevation-1" data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Add Disciplinary Case
                                </button>
                            </h4>

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
                                                    <th>Offender</th>
                                                    <th>Category</th>
                                                    <th>Subject</th>
                                                    <th>Severity</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i=0;$i<count($case);$i++)
                                                <tr>
                                                    <td>{{$case[$i]["staff"]["name"]}}</td>
                                                    <td>{{$case[$i]["category"]["disciplinary_category_name"]}}</td>
                                                    <td>{{$case[$i]["case_subject"]}}</td>
                                                    <td>{{$case[$i]["case_severity"]}}</td>
                                                    <td>{{$case[$i]["status"]["status_name"]}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href="{{ route('hrms.disciplinary_details', $case[$i]["id"]) }}"  class="btn btn-xs btn-info pull-right text-white text-bold border"> <i class="fa fa-eye"></i> View </a>
                                                            </div>
                                                            @if($case[$i]["status"]["id"]==2)
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right text-white text-bold" data-toggle="modal" data-target="#edit{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Edit </a>
                                                            </div>
                                                            @endif
                                                             @if($case[$i]["status"]["id"]==2||$case[$i]["status"]["id"]==3)
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-danger pull-right text-white text-bold" data-toggle="modal" data-target="#cancel{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Cancel </a>
                                                            </div>
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right text-white text-bold" data-toggle="modal" data-target="#edit{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Edit </a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                 <div class="modal fade" id="view{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{$case[$i]["case_subject"]}}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <dl class="row">
                                                                                        <dt class="col-sm-4">Case Description</dt>
                                                                                        <dd class="col-sm-8">{!! $case[$i]["case_description"] !!}</dd>
                                                                                        <dt class="col-sm-4">Case Opened</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["case_created_date"]}} @ {{$case[$i]["case_created_time"]}} </dd>
                                                                                        <dt class="col-sm-4">Opening Comments</dt>
                                                                                        <dd class="col-sm-8">{!!$case[$i]["case_created_comments"]!!}</dd>
                                                                                        @if($case[$i]["status"]["id"]==1)
                                                                                        <dt class="col-sm-4">Case Closed</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["case_closure_date"]}} @ {{$case[$i]["case_closure_time"]}} </dd>
                                                                                        <dt class="col-sm-4">Closing Comments</dt>
                                                                                        <dd class="col-sm-8">{!!$case[$i]["case_closure_comments"]!!}</dd>
                                                                                        @endif
                                                                                        <dt class="col-sm-4">Case Status</dt>
                                                                                        <dd class="col-sm-8">{{$case[$i]["status"]["status_name"]}} </dd>
                                                                                        <dt class="col-sm-4">Case Attachment</dt>
                                                                                        <dd class="col-sm-8">
                                                                                        <a href="{{ Storage::url($case[$i]["case_attachment"]) }}" download> Supporting Document </a></dd>
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

                                                    <div class="modal fade" id="edit{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <form action="{{route('hrms.disciplinary_case_update',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                        @csrf
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title">Edit Case</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Subject</label>
                                                                        <input type="text" name="subject" value="{{$case[$i]["case_subject"]}}" class="form-control" placeholder="Enter Request Subject">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <input type="text" name="description" value="{{$case[$i]["case_description"]}}" class="form-control" placeholder="Enter Request Description">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Supporting File </label>
                                                                        <input type="file" name="attachment" value="{{$case[$i]["case_attachment"]}}" class="form-control" placeholder="Upload Attachment">
                                                                        <a href="{{ Storage::url($case[$i]["case_attachment"]) }}" download> Supporting Document </a>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Category</label>
                                                                        <select class="form-control" name="category">
                                                                            @foreach($category as $key=> $categories)
                                                                            <option value="{{ $categories->id}}" {{$case[$i]["category"]["id"]== $categories->id ? 'selected' : ''}}>{{ $categories->disciplinary_category_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-end">
                                                                    <button type="submit" class="btn btn-info btn-flat elevation-1" >Save</button>
                                                                    <button type="button" class="btn btn-default btn-flat elevation-1" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="cancel{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.disciplinary_case_cancel',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title float-left">Cancel Request</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you Sure You Want To Cancel The Request?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger float-right">Yes</button>
                                                                </div>
                                                            </form>
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
       <div class="modal fade" id="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-default ">
                <div class="modal-content">
                    <form action="{{route('hrms.disciplinary_case_create')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Add Disciplinary Case</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select2" name="category" id="category">
                                <option value="#">None Selected</option>
                                @foreach($category as $key=> $categories)
                                <option value="{{ $categories->id}}">{{ $categories->disciplinary_category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter Case Subject">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control textarea" placeholder="Enter Case Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Severity</label>
                            <input type="number" name="severity" class="form-control" placeholder="Enter Case Severity">
                        </div>
                        <div class="form-group">
                            <label>Supporting File </label>
                            <input type="file" name="attachment" class="form-control" placeholder="Upload Attachment">
                        </div>
                        <div class="form-group">
                            <label for="users">Offender</label>
                            <select class="form-control select2bs4" name="users" id="users">
                            <option value="">None</option>
                            @foreach($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                            <span>
                                <label for="from" class="control-label">Opening Date</label>
                                <input type="date" class="form-control from" name="created_date" id="datepicker" placeholder="From" required>
                            </span>
                            </div>
                            <div class="form-group col-6">
                            <span>    
                                <label for="to" class="control-label">Opening Time</label>
                                <input type="time" class="form-control from" name="created_time" id="timepicker" placeholder="To" required>
                            </span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Opening Comments</label>
                            <textarea type="text" name="comments" class="form-control textarea" placeholder="Enter Case Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-info btn-flat elevation-1" >Save</button>
                        <button type="button" class="btn btn-default btn-flat elevation-1" data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
