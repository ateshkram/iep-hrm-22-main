@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Leave</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card card-outline ">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active " href="#type" data-toggle="tab">Pending Leave Applications</a></li>
                         <li class="nav-item"><a class="nav-link " href="#add" data-toggle="tab">Processed Leave Application</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane fade show " id="type">
                            <div class="row">
                                <div class="col-12">

                                    <div class="card card-info card-outline">
                                        <div class="card-body">
                                            {{--Main Card Body--}}
                                            <div class="form-group">
                                                <h4>
                                                    Recent Leave Request
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
                                                            <div class="table-responsive" style="overflow-x: auto;">
                                                                <table class="table table-bordered table-striped dataTable1">
                                                                    <thead>
                                                                    <tr>
                                                                         <th>ID</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Leave Type</th>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Available Leaves</th>
                                                                        <th>Comment</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @if(count($application)>0)
                                                                    @for($i=0;$i<count($application);$i++)
                                                                    <tr>
                                                                        <td>{{$application[$i]["employee"]["username"]}}</td>
                                                                        <td>{{$application[$i]["employee"]["name"]}}</td>
                                                                        <td>{{$application[$i]["leavetype"]["leave_type_name"]}}</td>
                                                                        <td>{{$application[$i]["start_date"]}}</td>
                                                                        <td>{{$application[$i]["end_date"]}}</td>
                                                                        <td>{{$application[$i]["employee"]["name"]}}</td>
                                                                        <td>{{$application[$i]["leave_application_comment"]}}</td>
                                                                        <td>{{$application[$i]["leavestatus"]["status_name"]}}</td>
                                                                        <td>
                                                                            <a data-toggle="modal" data-target="#edit{{$application[$i]["id"]}}">
                                                                                <span class="fa fa-edit"></span>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                        <div class="modal fade" id="edit{{$application[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                                            <div class="modal-dialog modal-default">
                                                                                <div class="modal-content">
                                                                                <form id="quickForm" action="{{route('hrms.leave_status_update',$application[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="modal-header">
                                                                                            <h4 class="modal-title">Leave Application</h4>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">×</span>
                                                                                            </button>
                                                                                        </div>

                                                                                        <div class="modal-body">
                                                                                            <div>
                                                                                               <dl class="row" >
                                                                                                <dt class="col-sm-6">Employee ID:</dt>
                                                                                                <dd class="col-sm-6">{{$application[$i]["employee"]["username"]}}</dd>
                                                                                                <dt class="col-sm-6">Employee Name:</dt>
                                                                                                <dd class="col-sm-6">{{$application[$i]["employee"]["name"]}}</dd>
                                                                                                <dt class="col-sm-6">Leave Type:</dt>
                                                                                                <dd class="col-sm-6">{{$application[$i]["leavetype"]["leave_type_name"]}}</dd>
                                                                                                <dt class="col-sm-6">Begin Date:</dt>
                                                                                                <dd class="col-sm-6">{{ Carbon\Carbon::parse($application[$i]["start_date"])->format('l jS F Y') }}</dd>
                                                                                                <dt class="col-sm-6">End Date:</dt>
                                                                                                <dd class="col-sm-6">{{ Carbon\Carbon::parse($application[$i]["end_date"])->format('l jS F Y') }}</dd>
                                                                                                <dt class="col-sm-6">leaves Available: </dt>
                                                                                               <dd class="col-sm-6">{{$total_available[$i]}} Days</dd>
                                                                                               <dt class="col-sm-6">Days Applied for: </dt>
                                                                                               <dd class="col-sm-6">{{$applied[$i]}} Days</dd>
                                                                                                <dt class="col-sm-6">Application Comment:</dt>
                                                                                                <dd class="col-sm-6">{{$application[$i]["leave_application_comment"]}}</dd>
                                                                                                <dt class="col-sm-6">Uploaded Document:</dt>
                                                                                                <dd class="col-sm-6">
                                                                                                    @if($application[$i]["leave_application_documents"]==null)
                                                                                                       No Documents Uploaded
                                                                                                    @else
                                                                                                     <a href="{{ Storage::url($application[$i]["leave_application_documents"]) }}" download> Supporting Document </a>
                                                                                                    @endif
                                                                                                </dd>
                                                                                            </dl>
                                                                                            </div>
                                                                                          <div class="form-group">
                                                                                                <label>Review</label>
                                                                                                <input type="text" name="review" value="" class="form-control" placeholder="Enter Your Review On the Leave Request" required>
                                                                                                <p  class="text-danger" >* required </p>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <div class="radio col-3">
                                                                                                    <label>
                                                                                                    <input type="radio" name="status" value="true" checked>
                                                                                                    Approve
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="radio col-3">
                                                                                                    <label>
                                                                                                    <input type="radio" name="status" value="false">
                                                                                                    Disapprove
                                                                                                    </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer justify-content-end">
                                                                                            <button type="submit" class="btn btn-info">Submit</button>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                    @endfor
                                                                    @endif
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
                         <div class="tab-pane fade" id="add">
                             <div class="row">
                                <div class="col-12">

                                    <div class="card card-info card-outline">
                                        <div class="card-body">
                                            {{--Main Card Body--}}
                                            <div class="form-group">
                                                <h4>
                                                    Leave Request History
                                                    {{-- <button type="button" class="btn btn-outline-info btn-flat float-right" data-toggle="modal" data-target="#modal">
                                                        <i class="nav-icon fas fa-filter"></i>
                                                        Filter
                                                    </button> --}}
                                                </h4>
                                                <hr>
                                                {{--Main table content--}}
                                                <div class="card-body">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-13 table-responsive" style="overflow-x: auto;">
                                                                <table id="example2" class="table table-bordered table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Leave Type</th>
                                                                        <th>Start Date</th>
                                                                        <th>End Date</th>
                                                                        <th>Pending Leaves</th>
                                                                        <th>Comment</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                @if(count($app)>0)
                                                                    @for($k=0;$k<count($app);$k++)
                                                                    <tr>
                                                                        <td>{{$app[$k]["employee"]["username"]}}</td>
                                                                        <td>{{$app[$k]["employee"]["name"]}}</td>
                                                                        <td>{{$app[$k]["leavetype"]["leave_type_name"]}}</td>
                                                                        <td>{{$app[$k]["start_date"]}}</td>
                                                                        <td>{{$app[$k]["end_date"]}}</td>
                                                                        <td>{{$app[$k]["employee"]["name"]}}</td>
                                                                        <td>{{$app[$k]["leave_application_comment"]}}</td>
                                                                        <td>
                                                                            @if($app[$k]["leavestatus"]["id"]==1)
                                                                            <div class="badge badge-warning elevation-1 ">Pending Approval</div>
                                                                            @elseif($app[$k]["leavestatus"]["id"]==2)
                                                                            <div class="badge badge-success elevation-1 ">Approved</div>
                                                                            @elseif($app[$k]["leavestatus"]["id"]==4)
                                                                            <div class="badge badge-danger elevation-1">Rejected</div>
                                                                            @elseif($app[$k]["leavestatus"]["id"]==3)
                                                                            <div class="badge badge-secondary elevation-1">Cancelled</div>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @endfor
                                                                @endif
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
                    </div>
                 </div>

<script>
    $(".action").on("change", function () {
    $modal = $('#approvemodal');
        $modal.modal('show');
});
</script>
@endsection
