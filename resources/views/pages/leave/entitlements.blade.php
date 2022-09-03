@extends('hrms.layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Entitlements</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Leaves</a>
                    </li>
                    <li class="breadcrumb-item active">Entitlements</li>
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
                                Leave Entitlement
                                <button type="button" class="btn btn-info btn-flat float-right" data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Add Entitlement
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
                                                    <th>Employee Name</th>
                                                    <th>Leave Type</th>
                                                    <th>Leave Period </th>
                                                    <th>Entitlement(No. of Days)</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                <td></td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td>
                                                    </td>
                                                    <td >
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right text-white text-bold"> <i class="fa fa-eye"></i> Edit </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
{{--                                                @endfor--}}
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
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Entitlement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
{{--                        <form action="{{ route('hrms.entitlement_create') }}" method="post"  enctype="multipart/form-data">--}}
                             @csrf
                        <label>Add to Multiple Employees: </label>
                        <input type="checkbox" name="multiple_employee" id="multiple_employee">

                        <div id="dvMultiple">

                        </div>
                        <div id="emp">
                            <div class="form-group">
                            <label>Employee Name</label>
                            <select class="form-control select2" style="width: 100%;" name="employee">
                           {{-- @foreach($employees as $key=> $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach--}}
                            </select>
                            </div>
                        </div>
                        <div id="countable"></div>
                        <div class="form-group">
                            <label>Leave Type</label>
                            <select class="form-control" name="leave" id="leave">
                               {{-- @foreach($leaves as $key=> $leave)
                                <option value="{{$leave->id}}">{{$leave->leave_type_name}}</option>
                            @endforeach--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Leave Period:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="date" class="form-control float-right" id="reservation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Entitlement</label>
                            <input type="number" name="days" class="form-control" placeholder="Enter Number of Days">
                        </div>

                        <div class="modal-footer justify-content-end">
                            <button type="submit" class="btn btn-info">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <script  type="text/javascript">


                 });

            </script>

@endsection
