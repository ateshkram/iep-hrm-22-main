@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    @if ($edit)
                        <li class="breadcrumb-item active">Edit Job Description</li>
                    @else
                        <li class="breadcrumb-item active">Create Job Description</li>
                    @endif

                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <!-- form start -->
        <form id="quickForm"
              enctype="multipart/form-data"
              @if ($edit)
              action="{{route('update-job-description', ['id'=> $job_description->id])}}" method="post"
              @else
              action="{{route('store-job-description')}}" method="post"
            @endif
        >
        @csrf
        <!-- jquery validation -->
            <div class="card card-teal card-outline elevation-3">
                <div class="card-header">
                    @if ($edit)
                        <h2 class="font-weight-bold">Edit Job Description</h2>
                    @else
                        <h2 class="font-weight-bold">Create Job Description</h2>
                    @endif

                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="job_title">Job Title</label>
                        <div class="col-sm-auto">
                            <input type="text" class="form-control" id="job_title" name="job_title" required placeholder="Specify Job Title"
                                   @if ($edit)
                                   value="{{$job_description->job_title}}"
                                @endif
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nature_scope">Nature & Scope</label>
                        <textarea class="form-control textarea" rows="3" id="nature_scope" name="nature_scope">
                            @if($edit)
                                {{$job_description->nature_scope}}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="key_responsibilities">Key Responsibilities</label>
                        <textarea class="form-control textarea" rows="10" id="key_responsibilities" name="key_responsibilities">
                            @if($edit)
                                {{$job_description->key_responsibilities}}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="minimum_qualifications">Minimum Qualifications</label>
                        <textarea class="form-control textarea" rows="3" id="minimum_qualifications" name="minimum_qualifications">
                            @if($edit)
                                {{$job_description->minimum_qualifications}}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="preferred_qualifications">Preferred Qualification</label>
                        <textarea class="form-control textarea" rows="3" id="preferred_qualifications" name="preferred_qualifications">
                            @if($edit)
                                {{$job_description->preferred_qualifications}}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="required_skills">Required Skills</label>
                        <select id="required_skills" name="required_skills[]" class="select2bs4" multiple="multiple" data-placeholder="Select a Skill"
                                style="width: 100%;">
                            @if($edit)
                                @foreach($job_description->skills as $skill)
                                    <option value={{$skill->id}} selected>{{$skill->skill_name}}</option>
                                @endforeach
                                @foreach($skills->diff($job_description->skills) as $skill)
                                    <option value="{{$skill->id}}">{{$skill->skill_name}}</option>
                                @endforeach
                            @else
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}">{{$skill->skill_name}}</option>
                                @endforeach
                            @endif

                        </select>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" value="submit" class="btn btn-primary">
                        @if($edit)
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        @endif
                        Save
                    </button>
                    <a class="btn btn-primary" href="{{route('all-job-descriptions')}}">Cancel</a>
                </div>
            </div>

        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection
