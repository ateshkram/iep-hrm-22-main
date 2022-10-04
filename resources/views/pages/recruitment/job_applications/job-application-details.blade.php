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
                <h1>Job Application Review</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">My Job Advertisements</a></li>
                    <li class="breadcrumb-item"><a href="#">Job Advertisement Details</a></li>
                    <li class="breadcrumb-item active">Job Application Review Details</li>
                </ol>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
        $(document).ready(function(){
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
    <div class="container">
        <!-- form start -->
        <div class="card card-outline card-info elevation-3">
            <div class="card-header">
                <h1 class="float-left font-weight-bold">{{$job_application->application_number}}</h1>
            </div>
            <div class="card-body">
                <h3 class="font-weight-bold">Personal Information</h3>
                <div class="row" >
                    <div class="form-group col-6">
                        <label for="full_name" class="control-label">Full Name</label>
                        <input class="form-control" value="{{$job_application->profile->name}}" disabled>

                    </div>
                    <div class="form-group col-6">
                        <label for="email" class="control-label">Email Address</label>
                        <input class="form-control" value="{{$job_application->profile->email}}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label>Gender</label>
                        <input class="form-control" value="{{$job_application->profile->gender}}" disabled>

                    </div>
                    <div class="form-group col-3">
                        <label for="dob" class="control-label">Date of Birth</label>
                        <input class="form-control" value="{{$job_application->profile->dob}}" disabled>

                    </div>
                    <div class="form-group col-3">
                        <label>Citizenship</label>
                        <input class="form-control" value="{{$job_application->profile->citizenship}}" disabled>
                    </div>
                    <div class="form-group col-3">
                        <label>Type Of Employment</label>
                        <input class="form-control" value="{{$job_application->profile->employment_type}}" disabled>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="postal" class="control-label">Postal Address</label>
                        <textarea class="form-control" disabled>{{$job_application->profile->postal_address}}</textarea>

                    </div>
                    <div class="form-group col-6">
                        <label for="residential" class="control-label">Residential Address</label>
                        <textarea class="form-control" disabled>{{$job_application->profile->residential_address}}</textarea>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="postal" class="control-label">Work Address</label>
                        <textarea class="form-control" disabled>{{$job_application->profile->work_address}}</textarea>

                    </div>
                    <div class="form-group col-6">
                        <label for="phone" class="control-label">Home Phone</label>
                        <input class="form-control" value="{{$job_application->profile->home_phone}}" disabled>

                        <label for="mobile" class="control-label">Work Phone</label>
                        <input class="form-control" value="{{$job_application->profile->work_phone}}" disabled>

                    </div>

                </div>

                <div class="row">
                    <div class="col-6"></div>
                    <div class="form-group col-6">
                        <label>Best phone Number to Contact for Interview</label>
                        <div class="row p-3">


                        </div>

                    </div>
                </div>

                <hr>
                <h3 class="font-weight-bold">Employment Information</h3>
                @if ($job_application->profile->previously_employed == 1)
                    <div class="form-group" >
                        <div class="row">
                            <div class="col-6">
                                <label>Have you ever been employed in this organisation?</label>
                                <div class="row pl-3">
                                    <input class="form-control" value="Yes" disabled>
                                </div>
                            </div>
                            <div class="col-6" id="emp_num">
                                <div class="form-group" id="emp_num">
                                    <label for="mobile" class="control-label">If YES, Please indicate Employee Number</label>
                                    <input class="form-control" value="{{$job_application->profile->employee_number}}" disabled>

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="form-group" >
                        <div class="row">
                            <div class="col-6">
                                <label>Have you ever been employed in this organisation?</label>
                                <div class="row pl-3">
                                    <input class="form-control" value="No" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                @if($job_application->profile->currently_employed == 1)
                    <div class="form-group">
                        <label>Are you currently employed in another position in the university?</label>
                        <div class="row pl-3">
                            <input class="form-control" value="Yes" disabled>
                        </div>

                        <div class="form-group" id="position_info">
                            <label for="mobile" class="control-label">If YES, Please indicate Position Title, Section, Department and Grade</label>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="residential" class="control-label">Postion Title</label>
                                    <input class="form-control" value="{{$job_application->profile->position_title}}" disabled>

                                </div>
                                <div class="form-group col-6">
                                    <label for="residential" class="control-label">Grade</label>
                                    <input class="form-control" value="{{$job_application->profile->grade}}" disabled>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="residential" class="control-label">Department</label>
                                    <input class="form-control" value="{{$job_application->profile->department}}" disabled>

                                </div>
                                <div class="form-group col-6">
                                    <label for="residential" class="control-label">Section</label>
                                    <input class="form-control" value="{{$job_application->profile->section}}" disabled>

                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endif

                <hr>
                <h3 class="font-weight-bold">Qualification Information</h3>
                @foreach($job_application->qualifications as $qualification)
                    <hr>
                    <div class="form-group ">
                        <label>Qualification Type</label>
                        <input class="form-control" value="{{$qualification->qualification_type}}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Institution Name</label>
                        <input class="form-control" value="{{$qualification->institution_name}}" disabled>

                    </div>
                    <div class="form-group">
                        <label>Qualification Name</label>
                        <input class="form-control" value="{{$qualification->qualification_name}}" disabled>

                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="start" class="control-label">Start date</label>
                            <input class="form-control" value="{{$qualification->start_date}}" disabled>

                        </div>
                        <div class="form-group col-3">
                            <label for="end" class="control-label">End Date</label>
                            <input class="form-control" value="{{$qualification->end_date}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Additional Information</label>
                        <textarea class="form-control" disabled>{{$qualification->additional_information}}</textarea>
                    </div>
                @endforeach

                <hr>
                <h3 class="font-weight-bold">Work Experience Information</h3>
                @foreach($job_application->workExperiences as $experience)
                    <div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input class="form-control" value="{{$experience->company_name}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Position Title</label>
                            <input class="form-control" value="{{$experience->position_title}}" disabled>
                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="start" class="control-label">Date Joined</label>
                                <input class="form-control" value="{{$experience->date_joined}}" disabled>
                            </div>
                            <div class="form-group col-3">
                                <label for="end" class="control-label">Date Left</label>
                                <input class="form-control" value="{{$experience->date_left}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Job Description</label>
                            <textarea class="form-control" disabled>{{$experience->job_description}}</textarea>

                        </div>
                    </div>
                @endforeach

                <hr>
                <h3 class="font-weight-bold">Attachments</h3>
                @foreach($job_application->attachments as $attachment)
                    <ul>
                        {{$attachment->file_url_link}}
                    </ul>
                @endforeach
                <hr>
                <h3 class="font-weight-bold">Declaration</h3>
                <p>
                    I hereby declare that the information given in this application is true and
                    correct to the best of my knowledge and belief. In case any information
                    given in this application proves to be false or incorrect, I shall be
                    responsible for the consequences.
                </p>
                <p>
                    I also declare that if any information provided by me is found false, my
                    candidature may be rejected at any point of time.
                </p>
                <p>
                    I am also aware that mere appearing for the online exam does not
                    mean that I am eligible for appointment to the post applied by me.
                </p>
                <div class="icheck-primary">
                    <input type="checkbox" id="declaration" name="terms" value="agree" checked disabled>
                    <label for="declaration">
                        Agree
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <form enctype="multipart/form-data"
                      action="{{route('review-job-application',['id' => $job_application->id])}}"
                      method="post">
                    <div class="card-header">
                        <h2>Official</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group ">

                            <div class="row pl-3">
                                <div class="form-check p-3">
                                    <label>Shortlist</label>
                                </div>

                                <div class="form-check p-3">
                                    <input class="form-check-input" id ="pre_employed_yes" type="radio" name="status" value="Shortlisted">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check p-3">
                                    <input class="form-check-input" id ="pre_employed_no" type="radio" name="status" value="Rejected">
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check p-3">
                                    <label>Review</label>
                                    <textarea rows="4" class="form-control" name="review"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="p-3">
                                    <button type="submit" value="submit"  class="btn btn-info float-right">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        Review</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div><!-- /.container-fluid -->



@endsection
