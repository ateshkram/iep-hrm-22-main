@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1>Employee Requests</h1> --}}
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
                                My Request
                                <button type="button" class="btn btn-info btn-flat float-right elevation-1" data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Add Request
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
                                                    <th>Request ID</th>
                                                    <th>Request Type</th>
                                                    <th>Subject</th>
                                                    <th>Priority</th>
                                                    <th>Status</th>
                                                    <th>Submitted Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i=0;$i<count($service);$i++)
                                                <tr>
                                                    <td>{{$service[$i]["id"]}}</td>
                                                    <td>{{$service[$i]["category"]["request_category_name"]}}</td>
                                                    <td>{{$service[$i]["request_subject"]}}</td>
                                                    <td>{{$service[$i]["priority"]["priority_name"]}}</td>
                                                    <td>{{$service[$i]["status"]["status_name"]}}</td>
                                                    <td>{{$service[$i]["request_created"]}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-info pull-right text-white text-bold" data-toggle="modal" data-target="#view{{$service[$i]["id"]}}"> <i class="fa fa-eye"></i> View </a>

                                                            </div>
                                                            @if($service[$i]["status"]["id"]==2)
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right text-white text-bold" data-toggle="modal" data-target="#edit{{$service[$i]["id"]}}"> <i class="fa fa-eye"></i> Edit </a>

                                                            </div>
                                                            @endif
                                                             @if($service[$i]["status"]["id"]==2||$service[$i]["status"]["id"]==3)
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-danger pull-right text-white text-bold" data-toggle="modal" data-target="#cancel{{$service[$i]["id"]}}"> <i class="fa fa-eye"></i> Cancel </a>

                                                            </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                 <div class="modal fade" id="view{{$service[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">{{$service[$i]["request_subject"]}}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                <div>
                                                                                    <dl class="row">
                                                                                        <dt class="col-sm-4">Request Description</dt>
                                                                                        <dd class="col-sm-8">{{$service[$i]["request_description"]}}</dd>
                                                                                        <dt class="col-sm-4">Request Priority</dt>
                                                                                        <dd class="col-sm-8">{{$service[$i]["priority"]["priority_name"]}} </dd>
                                                                                        <dt class="col-sm-4">Request Status</dt>
                                                                                        <dd class="col-sm-8">{{$service[$i]["status"]["status_name"]}} </dd>
                                                                                        <dt class="col-sm-4">Request Attachment</dt>
                                                                                        <dd class="col-sm-8">
                                                                                        <a href="{{ Storage::url($service[$i]["request_attachment"]) }}" download> Supporting Document </a></dd>
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

                                                    <div class="modal fade" id="edit{{$service[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                                <form action="{{route('hrms.request_update',$service[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                        @csrf
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title">Edit Request</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Subject</label>
                                                                        <input type="text" name="subject" value="{{$service[$i]["request_subject"]}}" class="form-control" placeholder="Enter Request Subject">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Description</label>
                                                                        <input type="text" name="description" value="{{$service[$i]["request_description"]}}" class="form-control" placeholder="Enter Request Description">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Supporting File </label>
                                                                        <input type="file" name="attachment" value="{{$service[$i]["request_attachment"]}}" class="form-control" placeholder="Upload Attachment">
                                                                        <a href="{{ Storage::url($service[$i]["request_attachment"]) }}" download> Supporting Document </a>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Priority</label>
                                                                        <select class="form-control" name="priority">
                                                                                @foreach($priority as $key=> $priorities)
                                                                            <option value="{{ $priorities->id}}" {{$service[$i]["priority"]["id"]== $priorities->id ? 'selected' : ''}}>{{ $priorities->priority_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                        <div class="form-group">
                                                                        <label>Category</label>
                                                                        <select class="form-control" name="category">
                                                                            @foreach($category as $key=> $categories)
                                                                            <option value="{{ $categories->id}}" {{$service[$i]["category"]["id"]== $categories->id ? 'selected' : ''}}>{{ $categories->request_category_name}}</option>
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

                                                    <div class="modal fade" id="cancel{{$service[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-default ">
                                                            <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.request_cancel',$service[$i]["id"])}}" method="post"  enctype="multipart/form-data">
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
                    <form action="{{route('hrms.request_create')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Add Request</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter Request Subject">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Request Description">
                        </div>
                        <div class="form-group">
                            <label>Supporting File </label>
                            <input type="file" name="attachment" class="form-control" placeholder="Upload Attachment">
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control" name="priority">
                                    @foreach($priority as $key=> $priorities)
                                <option value="{{ $priorities->id}}">{{ $priorities->priority_name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category">
                                @foreach($category as $key=> $categories)
                                <option value="{{ $categories->id}}">{{ $categories->request_category_name}}</option>
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


@endsection
