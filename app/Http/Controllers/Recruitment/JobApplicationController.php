<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\JobApplication;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobApplicationController extends Controller
{
    /**
     * JobApplicationController constructor.
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
            $job_applications = JobApplication::all();
            return view('pages.recruitment.job_applications.all-job-applications', compact('job_applications'));
        } catch (\Exception $e){

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
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        try {
            $job_application = JobApplication::find($id);
            return view('pages.recruitment.job_applications.job-application-details',compact('job_application'));
        } catch (\Exception $e){

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $application = JobApplication::find($id);
            $application->status = $request->status;
            $application->review = $request->review;
            $application->update();
            return redirect()->route('show-job-advertisement',['id' => $application->job_advertisement_id])->with('success');
        } catch (\Exception $e){
            return redirect()->route('show-job-advertisement',['id' => $application->job_advertisement_id])->with('error', "Error encountered");
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
        //
    }
}
