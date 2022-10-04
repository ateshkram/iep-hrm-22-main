@extends('layouts.app')

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('all-job-advertisements')}}">Job Advertisements</a></li>
                    <li class="breadcrumb-item active">Create Job Advertisement</li>
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
              action="{{route('update-job-advertisement', ['id'=> $job_advertisement->id])}}" method="post"
              @else
              action="{{route('store-job-advertisement')}}"
              method="post"
            @endif
        >
        @csrf
        <!-- jquery validation -->
            <div class="card card-info card-outline elevation-3">
                <div class="card-header">
                    <h2 class="font-weight-bold">Create Job Advertisement</h2>
                </div>
                <div class="card-body">
                    <h3 class="font-weight-bold">Position Information</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="position_title">Position Title</label>
                                <div class="col-sm-auto">
                                    <input  class="form-control" id="position_title" name="position_title" required placeholder="Specify Position"
                                            @if ($edit)
                                            value="{{$job_advertisement->position_title}}"
                                            @else
                                            value="{{$job_description->job_title}}"

                                        @endif
                                    >
                                    <input
                                        id="jd_id"
                                        type="hidden"
                                        name="jd_id"
                                        @if ($edit)
                                        value="{{$job_advertisement->job_description_id}}"
                                        @else
                                        value="{{$job_description->id}}"
                                        @endif
                                    >
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="employee_class">Employee Class</label>
                                <div class="col-sm-auto">
                                    <input type="text" class="form-control" id="employee_class" name="employee_class" required placeholder="Enter Employee Class"
                                           @if ($edit)
                                           value="{{$job_advertisement->employee_class}}"
                                        @endif
                                    >

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <div class="col-sm-auto">
                                    <input type="text" class="form-control" id="grade" name="grade" required placeholder="Enter Grade"
                                           @if ($edit)
                                           value="{{$job_advertisement->grade}}"
                                        @endif>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="FTE">FTE</label>
                                <div class="col-sm-auto">
                                    <input type="text" class="form-control" id="FTE" name="FTE" required placeholder="Enter FTE"
                                           @if ($edit)
                                           value="{{$job_advertisement->FTE}}"
                                        @endif>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Date and time range -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="opening_date">Opening Date</label>
                                <div class="col-sm-11">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <input type="date" id="opening_date" class="form-control" required name="opening_date" placeholder="Select Date"
                                                   @if ($edit)
                                                   value="{{$job_advertisement->opening_data}}"
                                                @endif
                                            >
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="closing_date">Closing Date</label>
                                <div class="col-sm-11">
                                    <div class="input-group">
                                        <div class="form-group">
                                            <input type="date" id="closing_date" class="form-control" required name="closing_date" placeholder="Select Date"
                                                   @if ($edit)
                                                   value="{{$job_advertisement->closing_date}}"
                                                @endif>
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                        </div>
                    </div>
                    <h3 class="font-weight-bold">Job Posting Location</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select id="department_id" required class="form-control select2bs4" name="department_id" style="width: 100%;">
                                    @if ($edit)
                                        <option selected="{{$job_advertisement->department->id}}">{{$job_advertisement->department->department_name}}</option>
                                    @else
                                        <option selected="">--</option>
                                    @endif

                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" required class="form-control" id="location" name="location" required placeholder="Enter Location"
                                       @if ($edit)
                                       value="{{$job_advertisement->location}}"
                                    @endif>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="reports_to">Reports To</label>
                                <input type="text" required class="form-control" id="reports_to" name="reports_to" required placeholder="Enter Reports To"
                                       @if ($edit)
                                       value="{{$job_advertisement->reports_to}}"
                                    @endif>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="supervised_by">Supervised By</label>
                                <input type="text" required class="form-control" id="supervised_by" name="supervised_by" required placeholder="Enter Supervisor"
                                       @if ($edit)
                                       value="{{$job_advertisement->supervised_by}}"
                                    @endif>
                            </div>
                        </div>
                    </div>
                    <h3 class="font-weight-bold">Post Description</h3>
                    <div class="form-group">
                        <label for="purpose">Purpose</label>
                        <textarea required class="form-control textarea" rows="3" id="purpose" name="purpose">
                            @if ($edit)
                                {!! $job_advertisement->purpose !!}}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="nature">Nature & Scope</label>
                        <textarea required class="form-control textarea" rows="3" id="nature" name="nature">
                            @if ($edit)
                                {!!$job_advertisement->nature_scope!!}
                            @else
                                {!!$job_description->nature_scope!!}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="key_responsibilities">Key Responsibilities</label>
                        <textarea class="form-control textarea" rows="3" id="key_responsibilities" name="key_responsibilities">
                            @if ($edit)
                                {!! $job_advertisement->key_responsibilities !!}
                            @else
                                {!!$job_description->key_responsibilities!!}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="min_qualifications">Minimum Qualifications</label>
                        <textarea required class="form-control textarea" rows="3" id="min_qualifications" name="min_qualifications">
                            @if ($edit)
                                {{$job_advertisement->minimum_qualifications}}
                            @else
                                {!!$job_description->minimum_qualifications!!}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="preferred_qualifications">Preferred Qualification</label>
                        <textarea  required class="form-control textarea" rows="3" id="preferred_qualifications" name="preferred_qualifications" >
                            @if ($edit)
                                {{$job_advertisement->preferred_qualifications}}
                            @else
                                {!!$job_description->preferred_qualifications!!}
                            @endif
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="required_skills">Required Skills</label>
                        <select  required id="required_skills" name="required_skills[]" class="select2bs4" multiple="multiple" data-placeholder="Select a Skill" disabled
                                style="width: 100%;">

                            @if($edit)
                                @foreach($job_advertisement->jobDescription->skills as $skill)
                                    <option selected="{{$skill->id}}">{{$skill->skill_name}}</option>
                                @endforeach
                            @else
                                @foreach($job_description->skills as $skill)
                                    <option selected="{{$skill->id}}">{{$skill->skill_name}}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>

                    <h3 class="font-weight-bold">Other Information</h3>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="salary_range">Salary Range</label>
                                <div class="col-sm-auto">
                                    <input required type="text" class="form-control" id="salary_range" name="salary_range" required placeholder="Enter Salary Range"
                                           @if ($edit)
                                           value="{{$job_advertisement->salary_range}}"
                                        @endif
                                    >
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contract_length">Length of Contract:</label>
                                <div class="col-sm-auto">
                                    <input required type="text" class="form-control" id="contract_length" name="contract_length" required placeholder="Enter Length of Contract"
                                           @if ($edit)
                                           value="{{$job_advertisement->contract_length}}"
                                        @endif
                                    >
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="reviewer">Reviewer</label>
                                <div class="col-sm-auto">
                                    <select required id="reviewer" class="form-control select2bs4" name="reviewer_id" style="width: 100%;">
                                        @if ($edit)
                                            <option selected="{{$job_advertisement->reviewer->id}}">{{$job_advertisement->reviewer->name}}</option>
                                        @else
                                            <option selected="">--</option>
                                        @endif

                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contact_person">Special Instructions to Applicants</label>
                                <div class="col-sm-auto">
                                    <input required type="text" class="form-control" id="contact_person" name="contact_person" required placeholder="Enter Contact Person Details"
                                           @if ($edit)
                                           value="{{$job_advertisement->contact_person}}"
                                        @endif
                                    >
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="checklists">Checklists</label>
                        <select required id="checklists" name="checklists[]" class="select2bs4" multiple="multiple" data-placeholder="Select a Checklist"
                                style="width: 100%;">

                            @if($edit)
                                @foreach($job_advertisement->checklists as $job_checklist)
                                    <option value="{{$job_checklist->id}}" selected="{{$job_checklist->id}}">{{$job_checklist->checklist_name}}</option>
                                @endforeach
                                @foreach($checklists->diff($job_advertisement->checklists) as $checklist)
                                    <option value="{{$checklist->id}}">{{$checklist->checklist_name}}</option>
                                @endforeach
                            @else
                                @foreach($checklists as $checklist)
                                    <option value="{{$checklist->id}}">{{$checklist->checklist_name}}</option>
                                @endforeach
                            @endif

                        </select>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" value="submit"  class="btn btn-primary">
                        @if($edit)
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                        @endif
                        <input type="hidden" id="draft" name="status" value="Draft" />
                        Submit</button>
                </div>
            </div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

@endsection

{{--@push('page_scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}

{{--            $( "#position_title" ).autocomplete({--}}
{{--                source: function( request, response ) {--}}
{{--                    // Fetch data--}}
{{--                    $.ajax({--}}
{{--                        url:"{{route('ajax-get-job-description')}}",--}}
{{--                        type: 'post',--}}
{{--                        dataType: "json",--}}
{{--                        data: {--}}
{{--                            _token: document.getElementsByName("_token")[0].value,--}}
{{--                            search: request.term--}}
{{--                        },--}}
{{--                        success: function( data ) {--}}
{{--                            response( data );--}}
{{--                        }--}}
{{--                    });--}}
{{--                },--}}
{{--                select: function (event, ui) {--}}
{{--                    // Set selection--}}
{{--                    $('#jd_id').val(ui.item.jd_id);--}}
{{--                    $('#nature')--}}
{{--                        .summernote('editor.pasteHTML',ui.item.nature_scope); // save selected id to input--}}
{{--                    $('#key_responsibilities').summernote('editor.pasteHTML',ui.item.key_responsibilities);--}}
{{--                    $('#min_qualifications').summernote('editor.pasteHTML',ui.item.minimum_qualifications);--}}
{{--                    $('#preferred_qualifications').summernote('editor.pasteHTML',ui.item.preferred_qualifications);--}}
{{--                    $('#position_title').val(ui.item.label);--}}
{{--                    return true;--}}
{{--                }--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
