@extends('layouts.app')
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
    <div class="col-md-15">
        <div class="card card-outline card-info">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active " href="#type" data-toggle="tab">Leave Type</a></li>
                    <li class="nav-item"><a class="nav-link " href="#add" data-toggle="tab">Add Leave Type</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane fade show " id="type">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="card-title">Leave Type List</h3>
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
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type Name</th>
                                                <th>Type Description</th>
                                                <th>Employee Class Entitled</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($leave)>0)
                                            @for($i=0;$i<count($leave);$i++)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>{{$leave[$i]["leave_type_name"]}}</td>
                                                    <td>{{$leave[$i]["leave_type_description"]}}</td>
                                                    <td>
                                                        @for($j=0;$j<count($leaves_en[$i]);$j++)
                                                            <small class="badge badge-info elevation-1">{{$leaves_en[$i][$j]["employee_class_name"]}}</small>
                                                        @endfor
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right  elevation-1 text-white text-bold" data-toggle="modal" data-target="#edit{{$leave[$i]["id"]}}"><i class="fas fa-edit"></i> Edit </a>

                                                                </div>
                                                                <div class="p-1">
                                                                    <a href="#"  class="btn btn-xs btn-danger pull-right elevation-1 text-white text-bold" data-toggle="modal" data-target="#view{{$leave[$i]["id"]}}"> <i class="fas fa-trash-alt"></i> Delete </a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" id="view{{$leave[$i]["id"]}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form id="quickForm" action="{{route('hrms.delete_leave_type',$leave[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-header bg-danger">
                                                                        <h4 class="modal-title float-left">Delete {{$leave[$i]["leave_type_name"]}}</h4>
                                                                        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you Sure to Delete {{$leave[$i]["leave_type_name"]}} type ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default float-left" data-dismiss="modal">cancel</button>
                                                                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <div class="modal fade" id="edit{{$leave[$i]["id"]}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info">
                                                                    <h4 class="modal-title">{{$leave[$i]["leave_type_name"]}}</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="quickForm" action="{{ route('hrms.leave_type_update',$leave[$i]["id"] )}}" method="post"  enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div >
                                                                            <div>
                                                                                <div class="form-group">
                                                                                    <label>Leave Name</label>
                                                                                    <input type="text" name="name" value="{{$leave[$i]["leave_type_name"]}}" class="form-control" placeholder="Enter Leave Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Leave Description</label>
                                                                                    <input type="text" name="description" value="{{$leave[$i]["leave_type_description"]}}" class="form-control" placeholder="Enter Leave Description">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Leave Eligibility</label>
                                                                                    <input type="text" name="eligibility"  @for($j=0;$j<count($leaves_en[$i]);$j++) value="{{$leaves_en[$i][$j]["leave_eligibility"]}}" @endfor  class="form-control" placeholder="Enter Leave leave eligibility or criteria">

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Leave Availability</label>
                                                                                    <input type="number" name="availability" @for($j=0;$j<count($leaves_en[$i]);$j++) value="{{$leaves_en[$i][$j]["leave_availability"]}}" @endfor  min="0" class="form-control" placeholder="Enter number of days of after service this leave would be available to use">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Leave Entitlement</label>
                                                                                    <input type="number" name="entitlement"  @for($j=0;$j<count($leaves_en[$i]);$j++) value="{{$leaves_en[$i][$j]["leave_entitlement"]}}" @endfor min="0" class="form-control" placeholder="Numbers of days entitled for this leave">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Carry Over </label>
                                                                                    <input type="number" name="carry" min="0"  @for($j=0;$j<count($leaves_en[$i]);$j++) value="{{$leaves_en[$i][$j]["leave_carry_over"]}}" @endfor class="form-control" placeholder="Numbers of days of leave carried to new year">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="select2-info">
                                                                                        <label>Employee Class</label>
                                                                                        <select class="form-control select2" name="employee_class[]" multiple="multiple" data-dropdown-css-class="select2-info" data-placeholder="Select Employee class that are eligible to this leave type"
                                                                                                style="width: 100%;">
                                                                                            @foreach($classes as $key=> $class)
                                                                                                <option value="{{$class->id}}" @for($j=0;$j<count($leaves_en[$i]);$j++) {{$leaves_en[$i][$j]["employee_class_id"] == $class->id ? 'selected' : ''}} @endfor>{{$class->employee_class_name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Gender</label>
                                                                                    <select class="form-control select2 select2-info" name="gender" data-placeholder="select gender if applicable">
                                                                                        <option {{$leave[$i]["gender"] == "All" ? 'selected' : ''}}>All</option>
                                                                                        <option {{$leave[$i]["gender"] == "Male"  ? 'selected' : ''}}>Male</option>
                                                                                        <option {{$leave[$i]["gender"] == "Female" ? 'selected' : ''}}>Female</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <input type="checkbox" name="approval" {{$leave[$i]["require_approval"] == "1" ? 'checked' : ''}}>
                                                                                            Leave Requires Approval
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>
                                                                                    <input type="checkbox" class="minimal" name="annual_leave" {{$leave[$i]["Annual_Leave"] == "1" ? 'checked' : ''}}>
                                                                                    If this Leave is accrued
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-info float-right">Save</button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                @endfor
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="add">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3 class="card-title">Add Leave Type</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form role="form" id="Add_leave" action="{{ route('hrms.leave_type_create') }}" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    <div >
                                        <div>
                                            <div class="form-group">
                                                <label>Leave Name</label>
                                                <input type="text" name="name" class="form-control" title="Enter the name of the leave" placeholder="Enter Leave Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Leave Description</label>
                                                <input type="text" name="description" class="form-control" placeholder="Enter Leave Description">
                                            </div>
                                            <div class="form-group">
                                                <label>Leave Eligibility</label>
                                                <span class="bi bi-info-circle" data-toggle="tooltip" data-placement="bottom"
                                                      title="You are entitled to paid annual leave if you have worked for your employer for at least 3 months. You can only apply for annual leave after working for 3 months."><i class="fas fa-info-circle info"></i></span>
                                                <input type="text" name="eligibility" class="form-control" placeholder="Enter Leave leave eligibility or criteria">
                                            </div>
                                            <div class="form-group">
                                                <label>Leave Availability</label>
                                                <span class="bi bi-info-circle" data-toggle="tooltip" data-placement="bottom"
                                                      title="Enter number of days of after service this leave would be available to use"><i class="fas fa-info-circle info"></i></span>
                                                <input type="number" name="availability" min="0" class="form-control" placeholder="Enter number of days of after service this leave would be available to use">
                                            </div>
                                            <div class="form-group">
                                                <label>Leave Entitlement</label>
                                                <span class="bi bi-info-circle" data-toggle="tooltip" data-placement="bottom"
                                                      title="Enter number of days of after service this leave would be available to use"><i class="fas fa-info-circle info"></i></span>
                                                <input type="number" name="entitlement" min="0" class="form-control" placeholder="Numbers of days entitled for this leave">
                                            </div>
                                            <div class="form-group">
                                                <label>Carry Over </label>
                                                <span class="bi bi-info-circle" data-toggle="tooltip" data-placement="bottom"
                                                      title="Enter number of days of after service this leave would be available to use"><i class="fas fa-info-circle info"></i></span>
                                                <input type="number" name="carry" min="0" class="form-control" placeholder="Numbers of days of leave carried to new year">
                                            </div>
                                            <div class="form-group">
                                                <label>Employee Class</label>
                                                <div class="select2-info">
                                                    <select class="form-control select2" name="employee_class[]" multiple="multiple" data-dropdown-css-class="select2-info" data-placeholder="Select Employee class that are eligible to this leave type"
                                                            style="width: 100%;">
                                                        @foreach($classes as $key=> $class)
                                                            <option value="{{$class->id}}">{{$class->employee_class_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control select2" name="gender" data-placeholder="select gender if applicable">
                                                <option>All</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                                <label>
                                                <input type="checkbox" class="minimal" name="approval">
                                                Leave Requires Approval
                                                </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                            <input type="checkbox" class="minimal" name="annual_leave">
                                             If this Leave is accrued
                                            </label>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info float-right">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->

            <!-- jQuery -->
            <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js')}}"></script>
            <script src="{{ asset('admin-lte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
            <script src="{{ asset('admin-lte/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script>
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#Add_leave').validate({
                        ignore: [],
                        rules: {
                            name: {
                                required: true
                            },
                            description: {
                                required: true,
                                minlength: 15
                            },
                            eligibility: {
                                required: true
                            },
                            availability: {
                                required: true
                            },
                            entitlement: {
                                required: true
                            },
                            carry: {
                                required: true
                            },
                            "employee_class[]": {
                                required: true,
                            },
                            gender: {
                                required: true
                            },
                        },
                        messages: {
                            name: "Please Enter A Leave Type!",
                            description: {
                                required: "Please provide a Description!",
                                minlength: "Your Description must be at least 15 characters long"
                            },
                            eligibility: "Please Enter the Eligibility Field!",
                            availability: "Please Enter the Value for Availability",
                            entitlement: "Please Enter the Value of Entitlement!",
                            carry: "Please Enter the Value To be Carried Over!",
                            "employee_class[]":"Please select an Employee Class one!!",
                            gender: "Please Enter the Value To be Carried Over!",
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
@endsection
