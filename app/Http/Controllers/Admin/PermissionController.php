<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * PermissionController constructor.
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
            $permissions = Permission::with('roles')->withCount('roles',)->get();
            return view('pages.admin.permission-management',compact('permissions'));
        }catch (\Exception $e){
            return view('pages.admin.permission-management',compact('permissions'))->with('error',$e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        try {

        }catch (\Exception $e){

        }
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
            Permission::findOrCreate($request->permission_name,'web');
            return redirect()->route('permission-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('permission-management')->with('error',$e);
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
        try {

        }catch (\Exception $e){

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        try {
            $permission = Permission::findById($id);
            $permission->name = $request->permission_name;
            $permission->update();
            return redirect()->route('permission-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('permission-management')->with('error',$e);
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
            Permission::destroy($id);
            return redirect()->route('permission-management')->with('success');

        }catch (\Exception $e){
            return redirect()->route('permission-management')->with('error',$e);
        }
    }
}
