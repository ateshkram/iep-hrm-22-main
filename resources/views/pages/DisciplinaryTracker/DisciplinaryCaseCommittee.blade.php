@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Disciplinary Cases</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Disciplinary Desk</a>
                    </li>
                    <li class="breadcrumb-item active">Disciplinary Committee Configure</li>
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
                                Disciplinary Committee Configure
                                <button type="button" class="btn btn-info btn-flat float-right elevation-1" data-toggle="modal" data-target="#modal">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Add Disciplinary Committee
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
                                                    <th>Disciplinary Committee</th>
                                                    <th>Staff Assigned</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @for($i=0;$i<count($committee);$i++)
                                                <tr>
                                                    <td>{{$committee[$i]["disciplinary_committee_name"]}}</td>
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
                                                                <a href=""  class="btn btn-xs btn-warning pull-right  elevation-1 text-white text-bold" data-toggle="modal" data-target="#edit{{$committee[$i]["id"]}}"> <i class="fas fa-edit"></i> Edit </a>

                                                            </div>
                                                            <div class="p-1">
                                                                <a href="#"  class="btn btn-xs btn-danger pull-right elevation-1 text-white text-bold" data-toggle="modal" data-target="#delete{{$committee[$i]["id"]}}"> <i class="fas fa-trash-alt"></i> Delete </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit{{$committee[$i]["id"]}}" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-default">
                                                        <div class="modal-content">
                                                        <form action="{{route('hrms.disciplinary_committee_update',$committee[$i]["id"])}}" id="edit_disciplinary_committee" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                    <div class="modal-header bg-info">
                                                                        <h4 class="modal-title">Modify Committee</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                     <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>Disciplinary Case Committee</label>
                                                                            <input type="text" value="{{$committee[$i]["disciplinary_committee_name"]}}" name="d_c_committee" class="form-control" placeholder="Enter name of disciplinary committee">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Select Staff to Assign to Above Committee</label>
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

                                                    <div class="modal fade" id="delete{{$committee[$i]["id"]}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form id="quickForm" action="{{route('hrms.disciplinary_committee_delete',$committee[$i]["id"])}}" method="post"  enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title float-left">Delete Disciplinary Committee</h4>
                                                                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to Delete this disciplinary case committee ?</p>
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
                        <h4 class="modal-title">Add Disciplinary Committee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{route('hrms.disciplinary_committee_create')}}" method="post" id="add_disciplinary_committee" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Disciplinary Case Committee</label>
                                <input type="text" name="committee" class="form-control" placeholder="Enter name of disciplinary committee">
                            </div>
                            <div class="form-group">
                                <label>Select Staff Assigned to Above Disciplinary Committee</label>
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
                    $('#add_disciplinary_type').validate({
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
                            request_type: "Please Enter A Disciplinary Type!",
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

                     $('#edit_disciplinary_type').validate({
                        ignore: [],
                        rules: {
                            d_c_category: {
                                required: true
                            },
                            d_c_description: {
                                required: true
                            },
                            d_c_tolerance: {
                                required: true
                            },
                            "assigned[]": {
                                required: true
                            },
                        },
                        messages: {
                            d_c_category: "Please Enter A Disciplinary Case Type!",
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
