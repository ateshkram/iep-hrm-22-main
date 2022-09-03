@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Apply Leave</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Leave</a></li>
                    <li class="breadcrumb-item active">Apply Leave </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        {{--Main Card Body--}}
                        <div class="form-group">
                            <h4>
                                Apply
                                <button type="button" class="btn btn-info btn-flat float-right elevation-1 " data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                   Application
                                </button>
                            </h4>
                        </div>
                        <hr>

                        {{--Main table content--}}
                        <div class="form-group card-body">
                            <div class="table-responsive">
                                <table class="table table-striped dataTable1" id="example1">
                                    <thead class="thead">
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Comment</th>
                                        <th>Supervisor's Review</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0;$i<count($application);$i++)
                                    <tr>
                                        <td>{{$application[$i]["leavetype"]["leave_type_name"]}}</td>
                                        <td>{{$application[$i]["start_date"]}}</td>
                                        <td>{{$application[$i]["end_date"]}}</td>

                                        <td>{{$application[$i]["leave_application_comment"]}}</td>
                                        <td>{{$application[$i]["leave_application_review"]}}</td>
                                        <td>
                                            @if($application[$i]["status_id"]==1)
                                            <div class="badge badge-warning elevation-1 ">Pending Approval</div>
                                            @elseif($application[$i]["status_id"]==2)
                                            <div class="badge badge-success elevation-1 ">Approved</div>
                                            @elseif($application[$i]["status_id"]==4)
                                            <div class="badge badge-danger elevation-1">Disapproved</div>
                                            @elseif($application[$i]["status_id"]==3)
                                            <div class="badge badge-secondary elevation-1">Cancelled</div>
                                            @endif
                                        </td>
                                        <td>
                                             @if($application[$i]["status_id"]==1)
                                            <div class="btn-group">
                                                    <div class="p-1">
                                                    <a href="#"  class="btn btn-xs btn-danger elevation-1 pull-right text-white text-bold" data-toggle="modal" data-target="#cancel{{$application[$i]["id"]}}"> <i class="fas fa-ban"></i> Cancel </a>
                                                </div>
                                            </div>
                                            @else
                                            No Action Applicable
                                            @endif
                                        </td>
                                    </tr>
                                         <div class="modal fade" id="cancel{{$application[$i]["id"]}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <form id="quickForm" action="{{route('hrms.leave_application_cancel',$application[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                            @csrf
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title float-left">Leave Cancellation </h4>
                                                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you Sure You Want to Cancel Your Leave Application ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger float-left" data-dismiss="modal">No</button>
                                                        <button type="submit" class="btn btn-default float-right">yes</button>
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
                        <hr>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Apply For New Leave</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{route('hrms.application_create')}}" method="post" id="leave_apply" enctype="multipart/form-data">
                             @csrf
                            <div class="form-group">
                                <label>Leave Type</label>
                                <select class="custom-select" id="leave_type" name="leave_type" required>
                                    @if(count($leave_type)<0)
                                        <option>No Options</option>
                                    @else
                                        <option selected="selected">Leave Type</option>
                                        @for($i=0;$i<count($leave_type);$i++)
                                            <option value="{{$leave_type[$i]["id"]}}">{{$leave_type[$i]["leave_type_name"]}}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Leave Balance</label>
                                <div class="callout callout-info">

                                    <h5 class="text-info"><strong>Leave Balance Details</strong></h5>
                                    <dl  id="annual" class="row" >
                                        <dt class="col-sm-4">Entitled:</dt>
                                        <dd class="col-sm-8"><small class="badge badge-info" id="entitled"></small></dd>
                                        <dt class="col-sm-4">Taken:</dt>
                                        <dd class="col-sm-8"><small class="badge badge-info" id="taken"></small></dd>
                                        <dt class="col-sm-4">Days Committed: </dt>
                                        <dd class="col-sm-8"><small class="badge badge-info" id="pending"></small></dd>
                                        <dt class="col-sm-4">Total Available:</dt>
                                        <dd class="col-sm-8"><small class="badge badge-info" value="" id="available"></small></dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="from" class="control-label">From Date</label>
                                    <input type="date" class="form-control from" name="from" id="datepicker" placeholder="From" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="to" class="control-label">To Date</label>
                                    <input type="date" class="form-control to" name="to" id="datepicker" placeholder="To" required>
                                </div>

                            </div>
                            <div class="row">
                                <dt class="col-sm-4">Days Appling For :</dt>
                             <dd class="col-sm-4"><input type="number" class="form-control to" name="days" id="days" placeholder="0" disabled></dd>
                            </div>
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" rows="3"  name="comment" placeholder="Enter ..."></textarea>
                            </div>
                             <div class="form-group">
                                <label class="control-label">Supporting Document (Optional)</label>
                                <input type="file" class="form-control " name="document"  placeholder="Upload Supporting document if applicable">
                            </div>
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-info">Apply</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

        <!-- jQuery -->
        <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('admin-lte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('admin-lte/plugins/jquery-validation/additional-methods.min.js')}}"></script>


        <script type="text/javascript">
            $(document).ready(function () {
                $.validator.addMethod("minDate", function(value, element) {
                    var curDate = new Date();
                    var inputDate = new Date(value);
                    if (inputDate > curDate)
                        return true;
                    return false;
                }, "Invalid Date!");

                $.validator.addMethod("maxDays", function(value, element) {
                    var avail = $("#available").val();  //available days
                    // var app = value;    //days applying for
                    if (value <= avail)
                        return true;
                    return false;
                }, "Invalid Date!");

                $('#leave_apply').validate({
                    ignore: [],
                    rules: {
                        "leave_type[]": {
                            required: true
                        },

                        from: {
                            required: true,
                            minDate:true
                        },
                        to: {
                            required: true,
                            minDate:true
                        },
                        comment: {
                            required: true,
                            minlength: 15
                        },
                        days:{
                            maxDays:true
                        },
                    },
                    messages: {
                        "leave_type[]": "Please Select A Leave Type!",
                        comment: {
                            required: "Please provide a reason for your leave!",
                            minlength: "Your Description must be at least 15 characters long"
                        },
                        from: {
                            required:"Please Select a Start Date for leave!",
                            minDate:"Please Select a Start Date after current date"
                        },
                        to: {
                            required:"Please Select a Start Date for leave!",
                            minDate:"Please Select a Start Date after current date"
                        },
                        days:{
                            maxDays:"You are exceed your available number of leaves"
                        } ,
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>


  <script  type="text/javascript">
                 $(document).ready(function(){

                    $("#leave_type").change(function(){
                        $.ajax({
                        dataType: "json",
                        type : 'post',
                        url :"{{route('hrms.entitlement_count')}}",

                        data:{
                            _token: document.getElementsByName("_token")[0].value,
                                 'leave': $('#leave_type').val()
                        },
                        success:function(data)
                        {
                            $entitle = data.entitlement;
                            $taken = data.taken;
                            $pending = data.pending;
                            $annual_leave = data.annual_leave;
                            $total_available = data.total_available;

                            if($annual_leave == 1){

                                 $carry_over = data.carry_over;
                                 $total_accrued = data.total_accrued;
                                 $current_accrual = data.current_accrual;

                                $("#entitled").html($entitle +' days');
                                $("#taken").html($taken + ' days');
                                $("#pending").html($pending + ' days');
                                $("#available").html($total_available + ' days');
                                $("#available").val($total_available);
                                $("#annual").append("<dt class='col-sm-4 annual'>Current Accrual</dt><dd class='col-sm-8 annual'><small class='badge badge-info' id='current_accrued' ></small></dd>");
                                $("#annual").append("<dt class='col-sm-4 annual'>Leave Carried Over</dt><dd class='col-sm-8 annual'><small class='badge badge-info' id='carried_over'></small></dd>");
                                $("#annual").append("<dt class='col-sm-4 annual'>Total Accrued</dt><dd class='col-sm-8 annual'><small class='badge badge-info' id='total_accrued'></small></dd>");
                                $("#current_accrued").html($current_accrual + ' days');
                                $("#carried_over").html($carry_over + ' days');
                                $("#total_accrued").html($total_accrued + ' days');

                             }
                            else{
                                $("#entitled").html($entitle +' days');
                                $("#taken").html($taken + ' days');
                                $("#pending").html($pending + ' days');
                                $("#available").html($total_available + ' days');
                                $(".annual").remove();
                            }

                        }


                    });

                 });

                 $(".from , .to").change(function(){

                        $.ajax({
                        dataType: "json",
                        type : 'post',
                        url :"{{route('hrms.days_count')}}",

                        data:{
                            _token: document.getElementsByName("_token")[0].value,
                                 'from': $('.from').val(),
                                  'to': $('.to').val()
                                // 'leave': $('#leave').val()
                        },
                        success:function(data)
                        {
                            $day = data.days;
                            //$("#days").html($day +' days');
                            $("#days").val($day);

                        }


                    });

                 });

            });

            </script>

@endsection
