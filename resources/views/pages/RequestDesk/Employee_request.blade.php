@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Employee Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Request Desk</a>
                    </li>
                    <li class="breadcrumb-item active">Employee Requests</li>
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
                    <div class="card-body ">
                        {{--Main Card Body--}}
                        <div class="form-group">
                            <h4>
                                Recent Employee Requests
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
                                                    <th>#</th>
                                                    <th>Request Type</th>
                                                    <th>Subject</th>
                                                    <th>Priority</th>
                                                    <th>Requester</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- {{dd(count($service))}} --}}
                                                    @for($i=0;$i<count($service);$i++)
                                                <tr>
                                                    <td id="service" value="{{$service[$i]["id"]}}" >{{$service[$i]["id"]}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="custom-select request_types" id="request_types" name="{{$service[$i]["id"]}}">
                                                                @for($j=0;$j<count($category);$j++)
                                                                <option value ="{{$category[$j]["id"]}}"  {{$service[$i]["category"]["id"] == $category[$j]["id"] ? 'selected' : ''}}>{{$category[$j]["request_category_name"]}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>{{$service[$i]["request_subject"]}}</td>
                                                    <td>{{$service[$i]["priority"]["priority_name"]}}</td>
                                                    <td>{{$service[$i]["requester"]["name"]}}</td>
                                                    <td>{{$service[$i]["request_created"]}}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="custom-select request_status" id="request_status" name="{{$service[$i]["id"]}}">
                                                                @for($j=0;$j<count($status);$j++)
                                                                <option value ="{{$status[$j]["id"]}}"  {{$service[$i]["status"]["id"] == $status[$j]["id"] ? 'selected' : ''}}>{{$status[$j]["status_name"]}} </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="modal{{$service[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-default">
                                                        <div class="modal-content">
                                                            <form action="{{route('hrms.close_request',$service[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Close Request</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                         <div class="form-group row">
                                                                             <div class="col-6">
                                                                             <label>Has requester acknowledged the resolution?</label>
                                                                             </div>
                                                                            <div class="radio col-3">
                                                                                <label>
                                                                                <input type="radio" name="status" value="true">
                                                                                    yes
                                                                                </label>
                                                                            </div>
                                                                            <div class="radio col-3">
                                                                                <label>
                                                                                <input type="radio" name="status" value="false">
                                                                                    No
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Comments</label>
                                                                            <input type="text" name="Comments" class="form-control" placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Request Closure Code</label>
                                                                            <select class="custom-select" name="name" >
                                                                            @for($k=0;$k<count($code);$k++)
                                                                                <option value="{{$code[$k]["id"]}}">{{$code[$k]["code_name"]}}</option>
                                                                            @endfor
                                                                            </select>
                                                                        </div>
                                                                           <div class="form-group">
                                                                            <label>Request Closure Comments / Status Change Comment	</label>
                                                                            <input type="text" name="Closure_Comments" class="form-control" placeholder="">
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
                                                     {{-- {{dd($service[2])}} --}}
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

    $(".request_status").on("change", function () {
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
                url :"{{route('hrms.request_status_update')}}",

                data:{
                    _token: document.getElementsByName("_token")[0].value,
                            'status': $("#request_status").val(),
                            'service':rid
                        // 'leave': $('#leave').val()
                },
                success:function(response)
                {
                   console.log('response', response);
                   Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        title: 'Request Status Updated Successfully',
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
