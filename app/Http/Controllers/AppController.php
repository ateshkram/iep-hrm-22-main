<?php

namespace App\Http\Controllers;

use App\Models\Recruitment\Candidate;
use App\Models\Recruitment\JobAdvertisement;
use App\Models\Recruitment\JobApplication;
use App\Models\Recruitment\JobDescription;
use App\Models\Users\Staff;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hrm_user_count = count(Staff::all());
        $portal_user_count = count(Candidate::all());
        $role_count = count(Role::all());
        $permission_count = count(Permission::all());

        $roles = Role::withCount('permissions')->get();
        $role_names = [];
        $role_user_count = [];
        $role_permission_count = [];
        foreach ($roles as $key => $role){
            $role_names[$key] = $role->name;
            $role->users_count = count(Staff::role(Role::findByName($role->name))->get());
            $role_user_count[$key] = $role->users_count;
            $role_permission_count[$key] = $role->permissions_count;
        }


//        dd($role_names,$role_permission_count,$role_user_count);




        $job_description_count = count(JobDescription::all());
        $job_advertisement_count = count(JobAdvertisement::all());
        $active_job_application_count = count(JobApplication::where('status','Applied')->get());
        $active_job_advertisement_count = count(JobAdvertisement::where('status','Published')->get());
        return view('pages.dashboard.index',compact(
            'hrm_user_count',
            'portal_user_count',
            'role_count',
            'role_user_count',
            'role_permission_count',
            'role_names',
            'permission_count',
            'job_description_count',
            'job_advertisement_count',
            'active_job_advertisement_count',
            'active_job_application_count'
        ));
    }

    public function staff_directory(){

        $users = Staff::where('guid','!=',null)->get();

        return view('pages.user.staff-directory',compact('users'));
    }
}
