<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$hrm_user_count}}</h3>

                <p>HRM Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users-cog"></i>
            </div>
            <a href="{{route('user-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="text-white">{{$portal_user_count}}</sup></h3>

                <p class="text-white">Job Portal Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{route('user-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 >{{$role_count}}</h3>

                <p >Roles</p>
            </div>
            <div class="icon">
                <i class="fas fa-address-card"></i>
            </div>
            <a href="{{route('role-management')}}" class="small-box-footer ">More info <i class="fas fa-arrow-circle-right "></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$permission_count}}</h3>

                <p>Permissions</p>
            </div>
            <div class="icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <a href="{{route('permission-management')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
