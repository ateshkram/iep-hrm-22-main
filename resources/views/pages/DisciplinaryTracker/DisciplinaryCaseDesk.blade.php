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
                                                    <th>#</th>
                                                    <th>Staff</th>
                                                    <th>Case Type</th>
                                                    <!--
                                                    <th>Offender</th>
                                                    <th>Subject</th>
                                                    -->
                                                    <th>Case Details</th>
                                                    <th>Case Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i=0;$i<count($case);$i++)
                                                <tr>
                                                    <td>{{$case[$i]["id"]}}</td>
                                                    <td>{{$case[$i]["staff"]["name"]}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="custom-select case_types" id="case_types" name="{{$case[$i]["id"]}}">
                                                                @for($j=0;$j<count($category);$j++)
                                                                <option value ="{{$category[$j]["id"]}}"  {{$case[$i]["category"]["id"] == $category[$j]["id"] ? 'selected' : ''}}>{{$category[$j]["disciplinary_category_name"]}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$case[$i]["case_subject"]}}                                                         
                                                        <a href="#"  class="btn btn-xs btn-info pull-right text-white text-bold" data-toggle="modal" data-target="#view{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> More </a>
                                                    </td>
                                                    <!--
                                                    <td>{{$case[$i]["staff"]["name"]}}</td>
                                                    
                                                    <td>{{$case[$i]["case_subject"]}}</td>
                                                    -->
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="custom-select case_status" id="case_status" name="{{$case[$i]["id"]}}">
                                                                @for($j=0;$j<count($status);$j++)
                                                                <option value ="{{$status[$j]["id"]}}"  {{$case[$i]["status"]["id"] == $status[$j]["id"] ? 'selected' : ''}}>{{$status[$j]["status_name"]}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-secondary pull-right text-white text-bold border" data-toggle="modal" data-target="#info{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Info </a>
                                                            </div>
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right text-white text-bold border" data-toggle="modal" data-target="#warn{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Warning </a>
                                                            </div>
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-primary pull-right text-white text-bold border" data-toggle="modal" data-target="#suspend{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Suspend </a>
                                                            </div>
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-danger pull-right text-white text-bold border" data-toggle="modal" data-target="#terminate{{$case[$i]["id"]}}"> <i class="fa fa-eye"></i> Terminate </a>
                                                            </div>
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

                                                    <div class="modal fade" id="info{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{$case[$i]["staff"]["name"]}}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                @for($j=0;$j<count($level);$j++)
                                                                    @if($case[$i]["user_id"] == $level[$j]["user_id"])
                                                                        @if($level[$j]["disciplinary_case_level_id"] == 1)
                                                                            @if($level[$j]["level_count"] == 1 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 33.33%" aria-valuenow="33.33" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            @elseif($level[$j]["level_count"] == 2 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 66.66%" aria-valuenow="66.66" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>                                                                            
                                                                            @elseif($level[$j]["level_count"] == 3 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>                                                                        
                                                                            @endif
                                                                        @elseif($level[$j]["disciplinary_case_level_id"] == 2)
                                                                            @if($level[$j]["level_count"] == 1 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <label>Suspension</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 49.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>                                                                            
                                                                            @elseif($level[$j]["level_count"] == 2 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <label>Suspension</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-primary" role="progressbar" style="width:99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            @endif                                                                        
                                                                        @elseif($level[$j]["disciplinary_case_level_id"] == 3)
                                                                            @if($level[$j]["level_count"] == 1 )
                                                                            <label>Warning</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <label>Suspension</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-primary" role="progressbar" style="width:99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <label>Termination</label>
                                                                            <div class="progress">
                                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 99.99%" aria-valuenow="99.99" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            @endif                                                                                                                                               
                                                                            @else
                                                                            <label>No data available</label>
                                                                            @endif
                                                                        @endif
                                                                @endfor
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
                                                                        <input type="text" name="subject" value="{{$case[$i]["case_subject"]}}" class="form-control" placeholder="Enter Case Subject">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <input type="text" name="description" value="{{$case[$i]["case_description"]}}" class="form-control" placeholder="Enter Case Description">
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

                                                    <div class="modal fade" id="warn{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.disciplinary_desk_warning',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                                <div class="modal-header bg-warning">
                                                                    <h4 class="modal-title float-left">Issue Warning</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure You Want to Issue a Warning to This Staff?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-warning float-right">Yes</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="suspend{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.disciplinary_desk_suspend',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                                <div class="modal-header bg-primary">
                                                                    <h4 class="modal-title float-left">Issue Suspension</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure You Want to Issue a Suspension to This Staff?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-primary float-right">Yes</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="terminate{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.disciplinary_desk_terminate',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title float-left">Issue Termination</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure You Want to Issue a Termination to This Staff?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">No</button>
                                                                    <button type="submit" class="btn btn-danger float-right">Yes</button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="modal{{$case[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-default">
                                                        <div class="modal-content">
                                                            <form action="{{route('hrms.case_close',$case[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title">Close Case</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-6">
                                                                            <span>
                                                                                <label for="from" class="control-label">Closing Date</label>
                                                                                <input type="date" class="form-control from" name="closed_date" id="datepicker" placeholder="From" required>
                                                                            </span>
                                                                            </div>
                                                                            <div class="form-group col-6">
                                                                            <span>    
                                                                                <label for="to" class="control-label">Closing Time</label>
                                                                                <input type="time" class="form-control from" name="closed_time" id="timepicker" placeholder="To" required>
                                                                            </span>
                                                                            </div>
                                                                        </div> 
                                                                         <div class="form-group">
                                                                            <label>Closing Comments</label>
                                                                            <textarea type="text" name="comments" class="form-control textarea"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Case Closure Code</label>
                                                                            <select class="custom-select" name="code" >
                                                                            @for($k=0;$k<count($code);$k++)
                                                                                <option value="{{$code[$k]["id"]}}">{{$code[$k]["code_name"]}}</option>
                                                                            @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-end">
                                                                        <button type="submit" class="btn btn-info btn-flat elevation-1">Save</button>
                                                                        <button type="button" class="btn btn-default btn-flat elevation-1" data-dismiss="modal">Cancel</button>
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
        
        <script type="text/javascript">
            $(document).ready(function(){

                $(".case_status").on("change", function () {
                    var rid = $(this).attr('name');
                    if($(this).val()=="1"){
                        $modal = $('#modal'+ rid);
                        $modal.modal('show');
                    }
                    else
                    {
                        $.ajax({
                            dataType: "json",
                            type : 'post',
                            url :"{{route('hrms.case_status_update')}}",

                            data:{
                                _token: document.getElementsByName("_token")[0].value,
                                        'status': $("#case_status").val(),
                                        'case':rid
                                    // 'leave': $('#leave').val()
                            },
                            success:function(response)
                            {
                            console.log('response', response);
                            Swal.fire({
                                    position: 'top-end',
                                    toast: true,
                                    icon: 'success',
                                    title: 'Case Status Updated Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }

                        });
                    }
                });


                $(".request_types").on("change", function () {
                        var rid = $(this).attr('name');
                        $.ajax({
                            dataType: "json",
                            type : 'post',
                            url :"{{route('hrms.request_types_update')}}",

                            data:{
                                _token: document.getElementsByName("_token")[0].value,
                                    'type': $("#request_types").val(),
                                    'service':rid
                            },
                            success:function(response)
                            {
                                console.log('response', response);
                                //alert('Something went wrong');
                                Swal.fire({
                                    position: 'top-end',
                                    toast: true,
                                    icon: 'success',
                                    title: 'Your Request Type Updated Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                        });

                });


            });


        </script>

@endsection
