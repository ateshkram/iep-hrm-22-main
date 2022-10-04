@extends('layouts.app')
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reports</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Leave</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$leave_applied}}</h3>

                        <p>Total Leave Applied</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        <h3>{{$staff_leave}}</h3>
                        <p> Employees On Leave</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>

                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$pending}}</h3>

                        <p>Total Pending Leave Request</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>10</h3>

                        <p> Holidays</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <div class="form-group">
                            </h4>
                            <div class="card  card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Leave Usage Report</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- <form> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Employee Class</label>
                                            <select name="employee_class" id="employee_class" class="form-control select2">
                                                <option value="-1" selected="selected">All</option>
                                                @foreach($employee_class as $row)
                                                <option value="{{$row->id}}">{{$row->employee_class_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Leave Type</label>
                                            <select name="type" id="type" class="form-control select2" required>
                                                <option value="" selected="selected">Leave Type Name</option>
                                                @foreach($type as $row)
                                                    <option value="{{$row->id}}">{{$row->leave_type_name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                            <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Section</label>
                                            <select name="section" id="section" class="form-control select2">
                                            <option value="-1" selected="selected">All</option>
                                            @foreach($section as $row)
                                            <option value="{{$row->id}}">{{$row->section_name}}</option>
                                            @endforeach
                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label>Department</label>
                                            <select name="department" id="department" class="form-control select2">
                                            <option value="-1" selected="selected">All</option>
                                            @foreach($department as $row)
                                            <option value="{{$row->id}}">{{$row->department_name}}</option>
                                            @endforeach
                                        </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Date range:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="range" id="reservation">
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="card-footer">
                                        <button type="" class="btn btn-info float-right" id="filter">
                                    <i class="nav-icon fas fa-plus"></i>
                                    Generate
                                </button>
                                </div>
                             {{-- </form> --}}
                            </div>
                        </div>

                        <div class="form-group card-body">
                        <div class ="table-responsive">
                            <table class="table table-striped table-hover" id="product_table" style="width:100%">
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">

    // function ShowHideDiv(btnMultiple) {
    //     var dvMultiple = document.getElementById("dvMultiple");
    //     dvMultiple.style.display = btnMultiple.value === "Leave" ? "block" : "none";
    // }

$(document).ready(function(){

    fetch_data();
    function fetch_data(type = '')
    {
        var table = $('#product_table').DataTable({
            "responsive": true,
            "processing": true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'pdf',
                'csv',
                {
                    extend: 'excel',
                    messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                    exportOptions: {
                        columns: ':visible:not(.notexport)'
                    }
                }
            ],
            ajax: {
                url:"{{route('hrms.report')}}",
                data: { _token: document.getElementsByName("_token")[0].value, type:type,
                    'department': $('#department').val(),
                    'class': $('#employee_class').val(),
                    'section': $('#section').val()
                    }
            },
            columns:[
                {
                data: 'username',
                name: 'username',
                title: 'ID'
                },
                {
                data: 'name',
                name: 'name',
                title: 'Employee Name'
                },
                {
                data: 'entitlement',
                name: 'entitlement',
                title: 'Leave Entitled'
                },
                {
                data: 'taken',
                name: 'taken',
                title: 'Leave Taken'
                },
                {
                // "visible": true,
                "render": function (data, type, row) {
                 if (row.current_accrual == undefined) {
                     row.current_accrual = 0;
                   table.column(4).visible(false);
                    }
                    else{
                        // table.column(4).visible(true)
                         return row.current_accrual;
                         }
                 },
                title: 'Current Accural',
                defaultContent: "<i>Not set</i>",
                 data: 'current_accrual',
                name: 'current_accrual'
                },
                {
                "render": function (data, type, row) {
                 if (row.total_accrued == undefined) {
                     row.total_accrued = 0;
                   table.column(5).visible(false);
                    }else{
                        //table.column(5).visible(true);
                        return row.total_accrued;
                    }
                 },
                defaultContent: "<i>Not set</i>",
                data: 'total_accrued',
                name: 'total_accrued',
                title: 'Total accrued'
                },
                {
                "render": function (data, type, row) {
                 if (row.carried_over == undefined) {
                     row.carried_over = 0;
                   table.column(6).visible(false);
                    }else{
                        //table.column(6).visible(true);
                        return row.carried_over;
                    }
                 },
                defaultContent: "<i>Not set</i>",
                data: 'carried_over',
                name: 'carried_over',
                title: 'Carried Over'
                },
                {
                data: 'total_available',
                name: 'total_available',
                title: 'Total Available'
                }
            ]
        });
    }
    $('#filter').click(function(){
        var type = $('#type').val();
        if(type === ''){
            Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        title: 'Request Status Updated Successfully',
                        showConfirmButton: false,
                        timer: 3000
                    })
        }else{
        $('#product_table').DataTable().destroy();
        fetch_data(type);
        }
    });
     $('#employee_class').change(function(){
         $.ajax({
                dataType: "json",
                type : 'get',
                url :"{{route('hrms.report')}}",
                data:{
                    _token: document.getElementsByName("_token")[0].value,
                            'employee_class': $('#employee_class').val()
                },
                success:function(data)
                {
                    $('#type').children('option:not(:first)').remove().end();
                        $.each(data,function(index,leave_type){
                            $('#type').append('<option value="'+leave_type.id+'"> '+leave_type.leave_type_name+' </option>')
                        });
                }
            });
    });
     $('#section').change(function(){
         $.ajax({
                dataType: "json",
                type : 'get',
                url :"{{route('hrms.report')}}",
                data:{
                    _token: document.getElementsByName("_token")[0].value,
                            'sections': $('#section').val()
                },
                success:function(data)
                {
                    $('#department').children('option:not(:first)').remove().end();
                         $.each(data,function(index,department){
                             $('#department').append('<option value="'+department.id+'"> '+department.department_name+' </option>')
                        });
                }
            });
    });
    //  $('#filter').click(function(){
    //      $.ajax({
    //             dataType: "json",
    //             type : 'get',
    //             url :"{{route('hrms.report')}}",
    //             data:{
    //                 _token: document.getElementsByName("_token")[0].value,
    //                         'type': $('#type').val(),
    //                         'department': $('#department').val(),
    //                         'class': $('#employee_class').val(),
    //                         'section': $('#section').val()
    //             },
    //             success:function(data)
    //             {
    //                  $('#product_table').DataTable().destroy();
    //                 fetch_data();
    //                 // $('#department').children('option:not(:first)').remove().end();
    //                 //      $.each(data,function(index,department){
    //                 //          $('#department').append('<option value="'+department.id+'"> '+department.department_name+' </option>')
    //                 //     });
    //             }
    //         });
    // });
});

</script>

@endsection
