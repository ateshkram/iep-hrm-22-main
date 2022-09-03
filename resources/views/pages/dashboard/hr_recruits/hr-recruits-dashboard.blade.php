<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$job_description_count}}</h3>

                <p>Job Descriptions</p>
            </div>
            <div class="icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <a href="{{route('user-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-orange">
            <div class="inner">
                <h3 class="text-white">{{$job_advertisement_count}}</sup></h3>

                <p class="text-white">Job Advertisements</p>
            </div>
            <div class="icon">
                <i class="fas fa-ad"></i>
            </div>
            <a href="{{route('user-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 class="text-white">{{$active_job_advertisement_count}}</h3>

                <p class="text-white">Active Job Advertisements</p>
            </div>
            <div class="icon">
                <i class="fas fa-ad"></i>
            </div>
            <a href="{{route('role-management')}}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right text-white"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-gradient-red">
            <div class="inner">
                <h3>{{$active_job_application_count}}</h3>

                <p>Active Job Applications</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="{{route('permission-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
