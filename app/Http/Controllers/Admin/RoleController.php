<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
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
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all();

            return view('pages.admin.role-management',compact('roles','permissions'));
        }catch (\Exception $e){
            return view('pages.admin.role-management',compact('roles','permissions'))->with('error',$e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $role = Role::findOrCreate($request->role_name);
            $role->givePermissionTo($request->permissions);

            return redirect()->route('role-management')->with('success');


        }catch (\Exception $e){
            return redirect()->route('role-management')->with('error',$e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $role = Role::findById($id);
            $role->name = $request->role_name;
            $role->givePermissionTo($request->role_permissions);
            $role->update();

            return redirect()->route('role-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('role-management')->with('error',$e);
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
            Role::destroy($id);

            return redirect()->route('role-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('role-management')->with('error',$e);
        }
    }
}
