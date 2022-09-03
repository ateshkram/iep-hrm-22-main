@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Job Description Details</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Job Descriptions</li>
                    <li class="breadcrumb-item active">Job Description Details</li>

                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="card card-info card-outline elevation-3">
            <div class="card-header">
                <h4>
                    <strong class="float-left">{{$job_description->job_title}}</strong>
                </h4>
                <img src="https://elearn.usp.ac.fj/theme/image.php/usp_corporate/theme/1597266338/usplogo-color" height="35px" alt="USP Logo" class="brand-image pr-2 float-right"
                     style="opacity: .8">

            </div>

            <div class="card-body">
                <div class="col">
                    <div class="row-10">
                        <div>
                            <h4 class="text-info font-weight-bold" >Nature & Scope</h4>
                        </div>
                        <div class="justify-content align-content-start">
                            {!!  $job_description->nature_scope!!}
                        </div>
                    </div>
                    <div class="row-10">
                        <div>
                            <h4 class="text-info font-weight-bold">Key Responsibilities</h4>
                        </div>
                        <div class="justify-content">
                            {!! $job_description->key_responsibilities !!}
                        </div>
                        {{--end row--}}

                    </div>
                    <div class="row-10">
                        <div>
                            <h4 class="text-info font-weight-bold">Minimum Qualifications</h4>
                        </div>
                        <div class=" justify-content">
                            {!! $job_description->minimum_qualifications !!}
                        </div>
                        {{--end row--}}
                    </div>

                    <div class="row-10">
                        <div>
                            <h4 class="text-info font-weight-bold">Preferred Qualifications</h4>
                        </div>
                        <div class="justify-content ">
                            {!! $job_description->preferred_qualifications !!}
                        </div>
                        {{--end row--}}
                    </div>

                    <div class="row-10">
                        <div>
                            <h4 class="text-info font-weight-bold">Required Skills</h4>
                        </div>
                        <div class="d-flex flex-wrap">
                            @foreach($job_description->skills as $skill)
                                <div class="p-1">
                                <span class="badge bg-teal">
                                    {{$skill->skill_name}}
                                </span>
                                </div>
                            @endforeach
                        </div>
                        {{--end row--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
