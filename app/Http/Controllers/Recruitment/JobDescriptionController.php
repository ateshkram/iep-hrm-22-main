<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Recruitment\JobDescription;
use App\Models\Recruitment\Skill;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobDescriptionController extends Controller
{
    /**
     * JobDescriptionController constructor.
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
            $job_descriptions = JobDescription::all();
            return view('pages.recruitment.job_description.job-descriptions',compact('job_descriptions'));
        } catch (\Exception $e){

        }

    }

    //Ajax request
    public function get_job_descriptions(Request $request){
        $search = $request->search;

        if ($search == '') {
            $jds = JobDescription::with('skills')->orderBy('job_title','asc')->limit(5)->get();
        }else {
            $jds = JobDescription::with('skills')->orderby('job_title','asc')->where('job_title', 'like', '%' .$search . '%')->limit(5)->get();
        }
        $response = array();
        foreach($jds as $jd){
            $response[] = array(
                "value"=>$jd->job_title,
                "label"=>$jd->job_title,
                "jd_id"=>$jd->id,
                "nature_scope" => $jd->nature_scope,
                "key_responsibilities" => $jd->key_responsibilities,
                "minimum_qualifications" => $jd->minimum_qualifications,
                "preferred_qualifications" => $jd->preferred_qualifications
            );
        }

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        try {
            $edit = false;
            $skills = Skill::all();
            return view('pages.recruitment.job_description.job-description-form',compact(['skills','edit']));
        } catch (\Exception $e){

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
            $jd = JobDescription::create([
                'job_title' => $request->job_title,
                'nature_scope' => $request->nature_scope,
                'key_responsibilities' => $request->key_responsibilities,
                'minimum_qualifications' => $request->minimum_qualifications,
                'preferred_qualifications' => $request->preferred_qualifications,
            ]);
            $jd->skills()->sync($request->required_skills);

            $jd->save();

            return redirect()->route('all-job-descriptions')->with('success','JD Successfully Created');
        } catch (\Exception $e){
            return redirect()->route('all-job-descriptions')->with('error','Error encountered');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {
        try {
            $job_description = JobDescription::find($id);
            return view('pages.recruitment.job_description.job-description-details',compact('job_description'));
        } catch (\Exception $e){

        }

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
            $job_description = JobDescription::find($id);
            $skills = Skill::all();
            $edit = true;

            return view('pages.recruitment.job_description.job-description-form',compact(['job_description','edit','skills']));
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
            $jd = JobDescription::find($id);

            $jd->job_title = $request->job_title;
            $jd->nature_scope = $request->nature_scope;
            $jd->key_responsibilities = $request->key_responsibilities;
            $jd->minimum_qualifications = $request->minimum_qualifications;
            $jd->preferred_qualifications = $request->preferred_qualifications;
            $jd->skills()->sync($request->required_skills);

            $jd->update();


            return redirect()->route('all-job-descriptions')->with('success', 'JD Successfully Updated');
        } catch (\Exception $e){
            return redirect()->route('all-job-descriptions')->with('error', 'Error encountered');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        try {
            JobDescription::destroy($id);

            return redirect()->route('all-job-descriptions')->with('success','JD Successfully Deleted');
        } catch (\Exception $e){
            return redirect()->route('all-job-descriptions')->with('error','Error encountered');
        }

    }
}
