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
                <h1>Disciplinary Case Dash</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Disciplinary Desk</a></li>
                    <li class="breadcrumb-item"><a href="#">Disciplinary Case </a></li>
                    <li class="breadcrumb-item active">Disciplinary Case Details</li>
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
                            <li class="nav-item "><a class="nav-link active info" href="#case_details" data-toggle="tab">Case Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#case_audit" data-toggle="tab">Case Progress</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="case_details">
                                <div class="container">
                                    <div class="card card-info card-outline elevation-3">
                                        <div class="card-body">
                                            <h4>

                                                <strong>{{$case->staff->name}} </strong>
                                                <small class="badge badge-info float-right">DC-{{$case->id}}</small>
                                            </h4>
                                            <hr>
                                            <div class="col">
                                                <div class="row-10">
                                                    <div>
                                                        <h4 class="text-info" >Case Overview</h4>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <dl class="row">
                                                                <dt class="col-sm-4">Case Category</dt>
                                                                <dd class="col-sm-8">	{{$case->category->disciplinary_category_name}}  </dd>

                                                                <dt class="col-sm-4">Category Details:</dt>
                                                                <dd class="col-sm-8">  {{$case->category->disciplinary_category_description}} </dd>

                                                                <dt class="col-sm-4">Category Tolerance:</dt>
                                                                <dd class="col-sm-8">   {{$case->category->disciplinary_category_tolerance}} </dd>

                                                                <dt class="col-sm-4">Case Committee:</dt>
                                                                <dd class="col-sm-8">
                                                                    
                                                                    @foreach($category as $categories)
                                                                       <p> {{ $loop->iteration }} : {{$categories->committee->disciplinary_committee_name}} </p>
                                                                    @endforeach
                                                                </dd>
                                                                <!--
                                                                <dt class="col-sm-4">Committee Staff:</dt>
                                                                <dd class="col-sm-8">
                                                                    @foreach($committee as $committees)
                                                                        @foreach($staff as $staffs)
                                                                            @if($committees->user_id == $staffs->id)
                                                                                <details> {{$staffs->name}} </details>
                                                                            @endif
                                                                       @endforeach
                                                                    @endforeach
                                                                </dd>
                                                                -->

                                                            </dl>
                                                        </div>
                                                    </div>
                                                    {{--end row--}}
                                                    <hr>
                                                    <div class="row-10">
                                                        <div>
                                                            <h4 class="text-info">Case Details</h4>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <dl class="row">
                                                                    <dt class="col-sm-4">Subject:</dt>
                                                                    <dd class="col-sm-8">{{$case->case_subject}}</dd>

                                                                    <dt class="col-sm-4">Description:</dt>
                                                                    <dd class="col-sm-8"> {!!$case->case_description!!} </dd>

                                                                    <dt class="col-sm-4">Severity:</dt>
                                                                    <dd class="col-sm-8"> {{$case->case_severity}} </dd>

                                                                    <dt class="col-sm-4">Attached Document:</dt>
                                                                    <dd class="col-sm-8"><a href="{{Storage::url($case->case_attachment)}}" download> Download Attachment </a> </dd>

                                                                    <dt class="col-sm-4">Case Status:</dt>
                                                                    <dd class="col-sm-8">   {{$case->status->status_name}} </dd>

                                                                </dl>
                                                            </div>
                                                        </div>
                                                        {{--end row--}}

                                                        <hr>
                                                        <div class="row-10">
                                                        <div>
                                                            <h4 class="text-info">Case Summary</h4>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <dl class="row">
                                                                    <dt class="col-sm-4">Case Opening Date:</dt>
                                                                    <dd class="col-sm-8">{{$case->case_created_date}}</dd>

                                                                    <dt class="col-sm-4">Case Opening Time:</dt>
                                                                    <dd class="col-sm-8"> {{$case->case_created_time}} </dd>

                                                                    <dt class="col-sm-4">Case Opening Comments:</dt>
                                                                    <dd class="col-sm-8"> {!!$case->case_created_comments!!} </dd>

                                                                    @if($case->case_status_id == 1)

                                                                    <dt class="col-sm-4">Case Closure Date:</dt>
                                                                    <dd class="col-sm-8">{{$case->case_closure_date}}</dd>

                                                                    <dt class="col-sm-4">Case Closure Time:</dt>
                                                                    <dd class="col-sm-8"> {{$case->case_closure_time}} </dd>

                                                                    <dt class="col-sm-4">Case Closure Comments:</dt>
                                                                    <dd class="col-sm-8"> {!!$case->case_closure_comments!!} </dd>

                                                                    @endif
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        {{--end row--}}
                                                    </div>
                                                    {{--end col--}}

                                                    {{--<a href="#" class="card-link float-right pt-2 ">See More</a>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                        <div class="tab-pane" id="case_audit">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-info card-outline elevation-3">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                        <h4>
                                                            <strong>{{$case->staff->name}} </strong>
                                                            <small class="badge badge-info float-right">DC-{{$case->id}}</small>
                                                        </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                <!-- Main node for this component -->
                                                    <div class="timeline">
                                                    <!-- Timeline time label -->
                                                    @foreach ($activity as $activities)
                                                    <div class="time-label">
                                                        <span class="bg-green">{{$activities->created_at->diffForHumans()}}</span>
                                                    </div>
                                                    <div>
                                                    <!-- Before each timeline item corresponds to one icon on the left scale -->
                                                        <i class="fas fa-user bg-blue"></i>
                                                        <!-- Timeline item -->
                                                        <div class="timeline-item">
                                                        <!-- Time -->
                                                        <span class="time"><i class="fas fa-clock"></i> {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $activities->created_at)->format('Y-m-d')}}</span>
                                                        <!-- Header. Optional -->
                                                        <h3 class="timeline-header"><a href="#">{{$activities->staff->name}}</a> added to this chain</h3>
                                                        <!-- Body -->
                                                        <div class="timeline-body">
                                                            {{$activities->description}}
                                                        </div>
                                                        <!-- Placement of additional controls. Optional -->
                                                        <!--
                                                        <div class="timeline-footer">
                                                            <a class="btn btn-primary btn-sm">Read more</a>
                                                            <a class="btn btn-danger btn-sm">Delete</a>
                                                        </div>
                                                        -->
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <!-- The last icon means the story is complete -->
                                                    <div class="col-md-4">
                                                        <i class="fas fa-clock bg-gray"></i>
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
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>

    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
