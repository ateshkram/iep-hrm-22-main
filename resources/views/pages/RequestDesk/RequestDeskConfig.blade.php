@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Request Desk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Request Desk</a>
                    </li>
                    <li class="breadcrumb-item active">Request Desk Configure</li>
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
                                Request Type Configure
                                <button type="button" class="btn btn-info btn-flat float-right elevation-1" data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Add Request Type
                                </button>
                            </h4>
                            {{-- <a href="{{route('hrms.sendmail')}}" class="btn btn-info">Send Mail</a> --}}
                            <hr>
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
                                                    <th>Request Type</th>
                                                    <th>Staff Assigned</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @for($i=0;$i<count($types);$i++)
                                                <tr>
                                                    <td>{{$types[$i]["request_category_name"]}}</td>
                                                    <td>
                                                        @for($j=0;$j<count($technicians[$i]);$j++)
                                                        <div>
                                                            {{$technicians[$i][$j]["name"]}}
                                                        </div>
                                                        @endfor
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="p-1">
                                                                <a href=""  class="btn btn-xs btn-warning pull-right  elevation-1 text-white text-bold" data-toggle="modal" data-target="#edit{{$types[$i]["id"]}}"> <i class="fas fa-edit"></i> Edit </a>

                                                            </div>
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-danger pull-right elevation-1 text-white text-bold" data-toggle="modal" data-target="#delete{{$types[$i]["id"]}}"> <i class="fas fa-trash-alt"></i> Delete </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit{{$types[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-default">
                                                        <div class="modal-content">
                                                        <form action="{{route('hrms.request_type_update',$types[$i]["id"])}}" id="edit_request_type" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title">Modify Reqest Type</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">??</span>
                                                                        </button>
                                                                    </div>
                                                                     <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Request Type Name</label>
                                                                            <input type="text" value="{{$types[$i]["request_category_name"]}}" name="request" class="form-control" placeholder="Enter type of request">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Select Staff Assigned to Handle Above Request Type</label>
                                                                            @for($j=0;$j<count($users);$j++)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                    <input type="checkbox" name="assigned[]" value=" {{$users[$j]["id"]}}"   @for($k=0;$k<count($technicians[$i]);$k++)  {{$users[$j]["id"] == $technicians[$i][$k]["user_id"] ? 'checked' : ''}} @endfor>
                                                                                        {{$users[$j]["name"]}}
                                                                                    </label>
                                                                                </div>
                                                                            @endfor
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

                                                    <div class="modal fade" id="delete{{$types[$i]["id"]}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.request_type_delete',$types[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title float-left">Delete Request Type</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you Sure to Delete this request type ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">cancel</button>
                                                                    <button type="submit" class="btn btn-danger float-right">Delete</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-default ">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">Add Request Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">??</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{route('hrms.request_type_create')}}" method="post" id="add_request_type" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Request Type Name</label>
                                <input type="text" name="request_type" class="form-control" placeholder="Enter type of request">
                            </div>
                            <div class="form-group">
                                <label>Select Staff Assigned to Handle Above Request Type</label>
                                @for($j=0;$j<count($users);$j++)
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="assigned[]" value=" {{$users[$j]["id"]}}">
                                            {{$users[$j]["name"]}}
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="submit" class="btn btn-info btn-flat elevation-1" >Save</button>
                                <button type="button" class="btn btn-default btn-flat elevation-1" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

!-- jQuery -->
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
                    $('#add_request_type').validate({
                        ignore: [],
                        rules: {
                            request_type: {
                                required: true
                            },
                            "assigned[]": {
                                required: true
                            },
                        },
                        messages: {
                            request_type: "Please Enter A Request Type!",
                            "assigned[]": "Please select employee !",

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

                 $(document).ready(function () {

                     $('#edit_request_type').validate({
                        ignore: [],
                        rules: {
                            request: {
                                required: true
                            },
                            "assigned[]": {
                                required: true
                            },
                        },
                        messages: {
                            request: "Please Enter A Request Type!",
                            "assigned[]": "Please select employee !",

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
