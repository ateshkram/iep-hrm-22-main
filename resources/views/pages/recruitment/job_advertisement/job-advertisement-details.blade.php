@extends('layouts.app')

@section('content-header')
    @if(session()->has('success'))
        <input type="hidden" value="{{Session::get('success')}}" id="hiddensuccesswcs">
    @endif
    @if(session()->has('error'))
        <input type="hidden" value="{{Session::get('error')}}" id="hiddenerrorwcs">
    @endif
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Job Advertisement Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Job Advertisements</a></li>
                    <li class="breadcrumb-item active">Job Advertisement Details</li>
                </ol>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function(){
            // document.getElementById('newscheckbox').attr="checked";
            hiddensuccess=$("#hiddensuccesswcs").val();
            swal("Successful", hiddensuccess, "success");

        });

        $(document).ready(function(){
            hiddenerror=$("#hiddenerrorwcs").val();
            swal("Error Encounted", hiddenerror, "error");
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card card-outline elevation-3">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item "><a class="nav-link active info" href="#job_details" data-toggle="tab">Job Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pending_applications" data-toggle="tab">Pending Applications</a></li>
                            <li class="nav-item"><a class="nav-link" href="#shortlisted_applicants" data-toggle="tab">Shortlisted Applicants</a></li>
                            <li class="nav-item"><a class="nav-link" href="#rejected_applicants" data-toggle="tab">Rejected Applicants</a></li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="job_details">
                                <div class="container">
                                    <div class="card card-info card-outline elevation-3">
                                        <div class="card-body">
                                            <h4>

                                                <strong>{{$job->position_title}} </strong>
                                                <small class="badge badge-info float-right">{{$job->position_number}}</small>
                                            </h4>
                                            <hr>
                                            <div class="col">
                                                <div class="row-10">
                                                    <div>
                                                        <h4 class="text-info" >Position Detail</h4>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <dl class="row">
                                                                <dt class="col-sm-4">Position Number</dt>
                                                                <dd class="col-sm-8">	{{$job->position_number}}  </dd>

                                                                <dt class="col-sm-4">Position Title:</dt>
                                                                <dd class="col-sm-8">{{$job->position_title}} </dd>

                                                                <dt class="col-sm-4">Employee Class:</dt>
                                                                <dd class="col-sm-8">{{$job->employee_class}}</dd>

                                                                <dt class="col-sm-4">Grade:</dt>
                                                                <dd class="col-sm-8">{{$job->grade}}</dd>

                                                                <dt class="col-sm-4">FTE:</dt>
                                                                <dd class="col-sm-8">{{$job->FTE}} </dd>

                                                                <dt class="col-sm-4">Length of Contract:</dt>
                                                                <dd class="col-sm-8"> {{$job->contract_length}}  </dd>

                                                                <dt class="col-sm-4">Closing Date:</dt>
                                                                <dd class="col-sm-8"> <small class="badge badge-info">
                                                                        {{$job->closing_date}}</small></dd>

                                                            </dl>
                                                        </div>
                                                    </div>
                                                    {{--end row--}}
                                                    <hr>
                                                    <div class="row-10">
                                                        <div>
                                                            <h4 class="text-info">Job Positing Location</h4>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <dl class="row">
                                                                    <dt class="col-sm-4">Location:</dt>
                                                                    <dd class="col-sm-8">{{$job->location}}</dd>

                                                                    <dt class="col-sm-4">Department:</dt>
                                                                    <dd class="col-sm-8"> {{$job->department->department_name}} </dd>

                                                                    <dt class="col-sm-4">Section:</dt>
                                                                    <dd class="col-sm-8"> {{$job->department->section->section_name}} </dd>

                                                                    <dt class="col-sm-4">Reports To:</dt>
                                                                    <dd class="col-sm-8">{{$job->reports_to}} </dd>

                                                                    <dt class="col-sm-4">Supervised by:</dt>
                                                                    <dd class="col-sm-8">{{$job->supervised_by}}</dd>

                                                                </dl>
                                                            </div>
                                                        </div>
                                                        {{--end row--}}

                                                        <hr>
                                                        <div class="row-10">
                                                            <div>
                                                                <h4 class="text-info">Job Description</h4>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <dl class="row-10">
                                                                        <dl>
                                                                            <dt>Purpose:</dt>
                                                                            <dd>
                                                                                {!! $job->purpose !!}
                                                                            </dd>

                                                                            <dt>Nature and Scope:</dt>
                                                                            <dd>
                                                                                {!! $job->nature_scope !!}
                                                                            </dd>

                                                                            <dt>Key Results Area:
                                                                                (For Advertisement)</dt>
                                                                            <dd>{!! $job->key_responsibilities !!}</dd>


                                                                            <dt>Minimum Qualifications:</dt>
                                                                            <dd>{!! $job->minimum_qualifications !!}</dd>
                                                                            <dt>Preferred Qualifications:</dt>
                                                                            <dd>{!! $job->preferred_qualifications !!}</dd>

                                                                            <dt>Skills:</dt>
                                                                            <dd>
                                                                                <div class="group pb-2">
                                                                                    @foreach($job->jobDescription->skills as $skill)
                                                                                        <small class="badge badge-info">{{$skill->skill_name}}</small>
                                                                                    @endforeach
                                                                                </div>
                                                                            </dd>
                                                                            <dt>Requirements</dt>
                                                                            <dd>
                                                                                <div class="group pb-2">
                                                                                    @foreach($job->checklists as $checklist)
                                                                                        <li class="pl-3">
                                                                                            <a class="disabled btn btn-xs btn-success pull-right text-white text-bold"> <i class="fas fa-check"></i> {{$checklist->checklist_name}}</a>
                                                                                        </li>

                                                                                    @endforeach
                                                                                </div>
                                                                            </dd>
                                                                        </dl>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                            {{--end row--}}
                                                        </div>
                                                    </div>
                                                    {{--end col--}}

                                                    {{--                                <a href="#" class="card-link float-right pt-2 ">See More</a>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="pending_applications">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-info card-outline elevation-3">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h3 class="card-title">Pending Applications</h3>
                                                        </div>
                                                        <div class="col-md-3">
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
                                                                    <th>Applicant Name</th>
                                                                    <th>Qualifications</th>
                                                                    <th>Work Experience</th>
                                                                    <th>Status</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($job->jobApplications->where('status','Applied') as $key => $job_application)
                                                                    <tr>
                                                                        <td>
                                                                            {{$job_application->application_number}}
                                                                        </td>
                                                                        <td>
                                                                            {{$job_application->candidate->name}}
                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->qualifications->sortByDesc('start_date') as $qualification)
                                                                                    <li >
                                                                                        {{$qualification->qualification_name}} at {{$qualification->institution_name}} ({{$qualification->start_date->format('Y')}} - {{$qualification->end_date->format('Y')}})
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>


                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->workExperiences->sortByDesc('date_joined') as $work_experience)
                                                                                    <li >
                                                                                        {{$work_experience->position_title}} at {{$work_experience->company_name}} from {{$work_experience->date_joined->format('M Y')}} to {{$work_experience->date_left->format('M Y')}} ({{$work_experience->date_left->format('Y') - $work_experience->date_joined->format('Y')}} Years)
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </td>
                                                                        <td>
                                                                            {{$job_application->status}}
                                                                        </td>
                                                                        <td>
                                                                            <div class="p-1">
                                                                                <a href="{{route('edit-job-application',['id'=>$job_application->id])}}"  class="btn btn-xs btn-warning pull-right text-white text-bold">Review </a>

                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div><!-- /.row (main row) -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="shortlisted_applicants">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-info card-outline elevation-3">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h3 class="card-title">Shortlisted Applicants</h3>
                                                        </div>
                                                        <div class="col-md-3">
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
                                                            <table class="table table-bordered table-striped dataTableExport">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Applicant</th>
                                                                    <th>Qualifications</th>
                                                                    <th>Work Experience</th>
                                                                    <th>Review</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($job->jobApplications->where('status','Shortlisted') as $key => $job_application)
                                                                    <tr>
                                                                        <td>
                                                                            {{$job_application->application_number}}
                                                                        </td>
                                                                        <td>
                                                                            <div class="col">
                                                                                {{$job_application->candidate->name}}            </div>
                                                                            <div class="col">
                                                                                {{$job_application->candidate->email}}
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->qualifications->sortByDesc('start_date') as $qualification)
                                                                                    <li >
                                                                                        {{$qualification->qualification_name}} at {{$qualification->institution_name}} ({{$qualification->start_date->format('Y')}} - {{$qualification->end_date->format('Y')}})
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>


                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->workExperiences->sortByDesc('date_joined') as $work_experience)
                                                                                    <li >
                                                                                        {{$work_experience->position_title}} at {{$work_experience->company_name}} from {{$work_experience->date_joined->format('M Y')}} to {{$work_experience->date_left->format('M Y')}} ({{$work_experience->date_left->format('Y') - $work_experience->date_joined->format('Y')}} Years)
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>


                                                                        </td>
                                                                        <td>
                                                                            {{$job_application->review}}
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div><!-- /.row (main row) -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="rejected_applicants">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-info card-outline elevation-3">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <h3 class="card-title">Rejected Applicants</h3>
                                                        </div>
                                                        <div class="col-md-3">
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
                                                            <table class="table table-bordered table-striped dataTableExport">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Applicant</th>
                                                                    <th>Qualifications</th>
                                                                    <th>Work Experience</th>
                                                                    <th>Review</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($job->jobApplications->where('status','Rejected') as $key => $job_application)
                                                                    <tr>
                                                                        <td data-orderable="false">
                                                                            {{$job_application->application_number}}
                                                                        </td>
                                                                        <td>
                                                                            <div class="col">
                                                                                {{$job_application->candidate->name}}            </div>
                                                                            <div class="col">
                                                                                {{$job_application->candidate->email}}
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->qualifications->sortByDesc('start_date') as $qualification)
                                                                                    <li >
                                                                                        {{$qualification->qualification_name}} at {{$qualification->institution_name}} ({{$qualification->start_date->format('Y')}} - {{$qualification->end_date->format('Y')}})
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>


                                                                        </td>
                                                                        <td>
                                                                            <ul>
                                                                                @foreach($job_application->workExperiences->sortByDesc('date_joined') as $work_experience)
                                                                                    <li >
                                                                                        {{$work_experience->position_title}} at {{$work_experience->company_name}} from {{$work_experience->date_joined->format('M Y')}} to {{$work_experience->date_left->format('M Y')}} ({{$work_experience->date_left->format('Y') - $work_experience->date_joined->format('Y')}} Years)
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>


                                                                        </td>
                                                                        <td>
                                                                            {{$job_application->review}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div><!-- /.row (main row) -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>

    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
