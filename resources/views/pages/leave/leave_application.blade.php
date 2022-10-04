@extends('hrms.layouts.app_staff')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Leave</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row pt-2">
            <div class="col-12 col-sm-6 col-md-3 ">
                <div class="info-box">
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Likes</span>
                        <span class="info-box-number">41,410</span>
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
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sales</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-teal elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">New Members</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="col-md-15">
            <div class="card ">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#type" data-toggle="tab">Leave Type</a></li>
                        <li class="nav-item"><a class="nav-link" href="#period" data-toggle="tab">Leave Period</a></li>
                        <li class="nav-item"><a class="nav-link" href="#week" data-toggle="tab">Work Week</a></li>
                        <li class="nav-item"><a class="nav-link" href="#holiday" data-toggle="tab">Holiday</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="type">
                              <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="card-title">Leave Type List</h3>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn btn-block btn-info pull-right text-white"
                                        data-toggle="modal" data-target="#modal"
                                        {{-- onclick="event.preventDefault(); document.getElementById('create-job-ad').submit();" --}}
                                        > <i class="fa fa-task"></i> New Leave Type</a>
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
                                                <th>Type Name</th>
                                                <th>Type Decription</th>
                                                <th>Type Entitlement</th>
                                                <th>Type Carry Over</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{-- @foreach($leaves as $key=> $leave)
                                                <tr>
                                                    <td>{{$leave->id}}</td>
                                                    <td>{{$leave->leave_type_name}}</td>
                                                    <td>{{$leave->leave_type_decription}}</td>
                                                    <td>{{$leave->leave_entitlement}}</td>
                                                    <td>{{$leave->leave_carry_over}}</td>
                                                    <td>
                                                        <div class="btn-group-vertical">
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-eye"></i> View </a>

                                                            </div>
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-eye"></i> Edit </a>

                                                            </div>
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-primary pull-right text-white text-bold"> <i class="fa fa-eye"></i> delete </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row (main row) -->
                        {{-- <button data-toggle="modal" data-target="#modal">add</button> --}}
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="period">
                            <button data-toggle="modal" data-target="#modal2">add</button>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="week">
                            <button data-toggle="modal" data-target="#modal3">add</button>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="holiday">
                            <button data-toggle="modal" data-target="#">add</button>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->

        <!-- /.modal -->
    <form id="quickForm" action="{{ route('hrms.leave_type_create') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal">
            <div class="modal-dialog modal-lg-1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Leave Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Leave Type Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Leave Name">
                        </div>
                        <div class="form-group">
                            <label>Leave Type Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Leave Description">
                        </div>
                         <div class="form-group">
                            <label>Leave Type Entitlement</label>
                            <input type="number" name="entitlement" min="0" class="form-control" placeholder="Enter total number of days entitled for leave type  ">
                        </div>
                         <div class="form-group">
                            <label>Leave Type eligibility</label>
                            <input type="text" name="eligibility" class="form-control" placeholder="Enter Leave leave eligibility or criteria">
                        </div>
                         <div class="form-group">
                            <label>Leave Type Availability</label>
                            <input type="number" name="availability" min="0" class="form-control" placeholder="Enter Leave number of days after DOC the leave will be available to apply">
                        </div>
                        <div class="form-group">
                            <label>Leave Type Carry Over </label>
                            <input type="number" name="carry" min="0" class="form-control" placeholder="Enter Leave leave eligibility or criteria">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
        <!-- /.modal -->
        <div class="modal fade" id="modal2">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Leave Period</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Start Month*</label>
                            <select class="custom-select">
                                <option>January</option>
                                <option>February</option>
                                <option>March</option>
                                <option>April</option>
                                <option>May</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Start Date*</label>
                            <select class="custom-select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>End Date*</label>
                            <input type="text" class="form-control" placeholder="December 31" disabled="">
                        </div>
                        <div class="form-group">
                            <label>Current Leave Period</label>
                            <input type="text" class="form-control" placeholder="2020-01-01 to 2020-12-31" disabled="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal3">
            <div class="modal-dialog modal-lg-1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Work Week</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="card-body">
                                  <div class="form-group row">
                                      <label for="inputEmail3" class="col-sm-2 col-form-label">Monday</label>
                                      <div class="col-sm-10">
                                          <select class="custom-select">
                                              <option>Full-Day</option>
                                              <option>Half-Day</option>
                                              <option>Non-Working Day</option>
                                          </select>
                                      </div>
                                  </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tuesday</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label pr-3">Wednesday</label>
                                    <div class="col-sm-10 pl-5">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Thursday</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Friday</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Saturday</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sunday</label>
                                    <div class="col-sm-10">
                                        <select class="custom-select">
                                            <option>Full-Day</option>
                                            <option>Half-Day</option>
                                            <option>Non-Working Day</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>    <!-- /.modal-dialog -->
    </form>
@endsection

