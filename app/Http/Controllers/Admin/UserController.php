<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\Candidate;
use App\Models\Users\Staff;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        try {
            $users = Staff::with('roles','notifications')->get();
            $candidates = Candidate::all();
            $roles = Role::all();
            $permissions = Permission::all();

            return view('pages.admin.user-management',compact('users','candidates','roles','permissions'));
        }catch (\Exception $e){

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $user = Staff::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->syncRoles(Role::findByName($request->role));

            return redirect()->route('user-management')->with('success','');
        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store_portal_user(Request $request)
    {
        try {
            Candidate::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('user-management')->with('success','');

        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {

        }catch (\Exception $e){

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function assign_extra_permissions(Request $request, $id)
    {
        try {
            $user = Staff::find($id);
            $user->syncPermissions($request->extra_permissions);
            $user->update();
            return redirect()->route('user-management')->with('success','');
        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function assign_new_role(Request $request, $id)
    {
        try {
            $user = Staff::find($id);
            $user->syncRoles(Role::findByName($request->role));
            $user->update();
            return redirect()->route('user-management')->with('success','');
        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Staff::destroy($id);
            return redirect()->route('user-management')->with('success','');

        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy_portal_user($id)
    {
        try {
            Candidate::destroy($id);
            return redirect()->route('user-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('user-management')->with('error',$e);
        }
    }
}
