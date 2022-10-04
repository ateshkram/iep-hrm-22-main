<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('staff-directory')}}" class="nav-link">
        <i class="nav-icon fas fa-address-book"></i>
        <p>Staff Directory</p>
    </a>
</li>
@canany(
    [\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT,
    \App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT,
    \App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT,]
)
    <li class="nav-header">Administration</li>
    @can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_USER_MANAGEMENT)
        <li class="nav-item">
            <a class="nav-link"
               href="{{route('user-management')}}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>User Management</p>
            </a>
        </li>
    @endcan
    @can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_ROLE_MANAGEMENT)
        <li class="nav-item">
            <a class="nav-link"
               href="{{route('role-management')}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Role Management</p>
            </a>
        </li>
    @endcan
{{--    @can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_PERMISSION_MANAGEMENT)--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link"--}}
{{--               href="{{route('permission-management')}}">--}}
{{--                <i class="nav-icon fas fa-user-lock"></i>--}}
{{--                <p>Permissions Management</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    @endcan--}}
@endcanany
@canany(
    [\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_MY_JOB_ADVERTISEMENTS,
    \App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS,
    \App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS,
    \App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_APPLICATIONS])
    <li class="nav-header">Recruitment</li>
@endcanany

@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_DESCRIPTIONS)
    <li class="nav-item">
        <a href="{{route('all-job-descriptions')}}" class="nav-link">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>Job Descriptions</p>
        </a>
    </li>
@endcan

@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_ADVERTISEMENTS)
    <li class="nav-item">
        <a href="{{route('all-job-advertisements')}}" class="nav-link">
            <i class="nav-icon fas fa-ad"></i>
            <p>Job Advertisements</p>
        </a>
    </li>
@endcan

{{--@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_JOB_APPLICATIONS)--}}
{{--    <li class="nav-item">--}}
{{--        <a href="{{route('all-job-applications')}}" class="nav-link">--}}
{{--            <i class="nav-icon fas fa-network-wired"></i>--}}
{{--            <p>Job Applications</p>--}}
{{--        </a>--}}
{{--    </li>--}}
{{--@endcan--}}

@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_MY_JOB_ADVERTISEMENTS)
    <li class="nav-item">
        <a href="{{route('my-job-advertisements')}}" class="nav-link">
            <i class="nav-icon fab fa-buffer"></i>
            <p>My Job Advertisements</p>
        </a>
    </li>
@endcan

<li class="nav-header">Leave</li>
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_LEAVE_CONFIG)
    <li class="nav-item">
        <a href="{{route('hrms.leave')}}" class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>Leave Config</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_LEAVE)
    <li class="nav-item">
        <a href="{{route('hrms.leave_apply')}}" class="nav-link">
            <i class="nav-icon fab fa-telegram-plane"></i>
            <p>Leave</p>
        </a>
    </li>
@endcan

@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_LEAVE_REPORTS)
    <li class="nav-item">
        <a href="{{route('hrms.report')}}" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Leave Reports</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_LEAVE_LIST)
    <li class="nav-item">
        <a href="{{route('hrms.leave_list')}}" class="nav-link">
            <i class="nav-icon fas fa-plane-departure"></i>
            <p>Leave List</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_LEAVE_HISTORY)
    <li class="nav-item">
        <a href="{{route('hrms.leave_history')}}" class="nav-link">
            <i class="nav-icon fas fa-plane-departure"></i>
            <p>Annual Leave History</p>
        </a>
    </li>
@endcan
<li class="nav-header">Request/Service Desk</li>
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_REQUEST_CONFIG)
    <li class="nav-item">
        <a href="{{route('hrms.request_config')}}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>Request Config</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_REQUEST_SERVICE_DESK)
    <li class="nav-item">
        <a href="{{route('hrms.request')}}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>Request Service Desk</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_EMPLOYEE_REQUESTS)
    <li class="nav-item">
        <a href="{{route('hrms.Employee_request')}}" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Employee Requests</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_ASSIGNED_REQUESTS)
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Assigned Requests</p>
        </a>
    </li>
@endcan

<li class="nav-header">Disciplinary</li>
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_DISCIPLINARY_CONFIG)
    <li class="nav-item">
        <a href="{{route('hrms.disciplinary_config')}}" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>Disciplinary Config</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_DISCIPLINARY_COMMITTEE)
    <li class="nav-item">
        <a href="{{route('hrms.disciplinary_committee')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Disciplinary Committee</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_DASHBOARD)
    <li class="nav-item">
        <a href="{{route('hrms.disciplinary_case')}}" class="nav-link">
            <i class="nav-icon fas fa-chart-area"></i>
            <p>Disciplinary Cases</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_DESK)
    <li class="nav-item">
        <a href="{{route('hrms.disciplinary_desk')}}" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>Disciplinary Case Desk</p>
        </a>
    </li>
@endcan
@can(\App\Models\Organisation\ACL::PERMISSION_VIEW_MENU_DISCIPLINARY_CASE_MY)
    <li class="nav-item">
        <a href="{{route('hrms.my_disciplinary_case')}}" class="nav-link">
            <i class="nav-icon fas fa-id-badge"></i>
            <p>My Disciplinary Cases</p>
        </a>
    </li>
@endcan