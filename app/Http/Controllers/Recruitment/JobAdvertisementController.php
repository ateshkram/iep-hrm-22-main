<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use App\Models\Organisation\Department;
use App\Models\Organisation\Section;
use App\Models\Recruitment\Checklist;
use App\Models\Recruitment\JobAdvertisement;
use App\Models\Recruitment\JobApplication;
use App\Models\Recruitment\JobDescription;
use App\Models\Recruitment\Skill;
use App\Models\Users\Staff;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobAdvertisementController extends Controller
{
    /**
     * JobAdvertisementController constructor.
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
            $job_ads = JobAdvertisement::with('department', 'checklists','jobDescription')->get();
            return view('pages.recruitment.job_advertisement.job-advertisements',compact('job_ads'));
        } catch (\Exception $e){

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function my_job_advertisements()
    {
        try {
            $user_id = auth()->user()->id;
            $job_advertisements = JobAdvertisement::with('jobDescription','checklists')->where('reviewer_id',$user_id)->get();
            $job_applications = JobApplication::where('reviewer_id',$user_id)->get();

            return view('pages.recruitment.job_advertisement.my-job-advertisements',compact(['job_advertisements','job_applications']));
        } catch (\Exception $e){

        }

    }

    public function publish($id){
        try {
            $job = JobAdvertisement::find($id);

            $job->status = 'Published';
            $job->update();

            return redirect()->route('my-job-advertisements')->with('success');
        } catch (\Exception $e){

        }

    }

    public function unpublish($id){
        try {
            $job = JobAdvertisement::find($id);

            $job->status = 'Closed';
            $job->update();

            return redirect()->route('my-job-advertisements')->with('success');
        } catch (\Exception $e){

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        try {
            $skills = Skill::all();
            $staffs = Staff::all();
            $jds = JobDescription::all();
            $checklists = Checklist::all();
            $departments = Department::all();
            $sections = Section::all();
            $job_description = JobDescription::find(request()->job_description);
//            dd($job_description);
            $edit=false;
            return view('pages.recruitment.job_advertisement.job-advertisement-form',compact(['skills','jds','checklists','departments','sections','edit','staffs','job_description']));
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
            $job_ad = JobAdvertisement::factory()->create([
                'position_title' => $request->position_title,
                'purpose' => $request->purpose,
                'employee_class' => $request->employee_class,
                'salary_range' => $request->salary_range,
                'grade' => $request->grade,
                'FTE' => $request->FTE,
                'location' => $request->location,
                'reports_to' => $request->reports_to,
                'supervised_by' => $request->supervised_by,
                'nature_scope' => $request->nature,
                'key_responsibilities' => $request->key_responsibilities,
                'minimum_qualifications' => $request->min_qualifications,
                'preferred_qualifications' => $request->preferred_qualifications,
                'contract_length' => $request->contract_length,
                'opening_date' => $request->opening_date,
                'closing_date' => $request->closing_date,
                'contact_person' => $request->contact_person,
                'status' => $request->status,
                'department_id' => $request->department_id,
                'creator_id' => auth()->user()->id,
                'reviewer_id' => $request->reviewer_id,
                'job_description_id' => $request->jd_id,

            ]);

            $job_ad->checklists()->sync($request->checklists);

            $job_ad->save();

            return redirect()->route('all-job-advertisements')->with('success', 'Job Ad Successfully Created');
        } catch (\Exception $e){
            return redirect()->route('all-job-advertisements')->with('Error', 'Error Encountered');
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
            $job = JobAdvertisement::find($id);
            return view('pages.recruitment.job_advertisement.job-advertisement-details',compact('job'));
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
            $job_advertisement = JobAdvertisement::find($id);
            $skills = Skill::all();
            $staffs = Staff::all();
            $jds = JobDescription::all();
            $checklists = Checklist::all();
            $departments = Department::all();
            $sections = Section::all();
            $edit = true;
            return view('pages.recruitment.job_advertisement.job-advertisement-form',compact(['job_advertisement','edit','skills','jds','checklists','departments','sections','staffs']));
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
            $job = JobAdvertisement::find($id);
            $job->position_title = $request->position_title;
            $job->purpose = $request->purpose;
            $job->employee_class = $request->employee_class;
            $job->salary_range = $request->salary_range;
            $job->grade = $request->grade;
            $job->FTE = $request->FTE;
            $job->location = $request->location;
            $job->reports_to = $request->reports_to;
            $job->supervised_by = $request->supervised_by;
            $job->nature_scope = $request->nature;
            $job->key_responsibilities = $request->key_responsibilities;
            $job->minimum_qualifications = $request->min_qualifications;
            $job->preferred_qualifications = $request->preferred_qualifications;
            $job->contract_length = $request->contract_length;
            $job->opening_date = $request->opening_date;
            $job->closing_date = $request->closing_date;
            $job->contact_person = $request->contact_person;
            $job->status = $request->status;
            $job->department_id = $request->department_id;
            $job->job_description_id = $request->jd_id;

            $job->checklists()->sync($request->checklists);

            $job->update();

            return redirect()->route('all-job-advertisements')->with('success');
        } catch (\Exception $e){
            return redirect()->route('all-job-advertisements')->with('error');
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
            $job = JobAdvertisement::find($id);
            $job->delete();

            return redirect()->route('job-advertisements')->with('success');
        } catch (\Exception $e){
            return redirect()->route('job-advertisements')->with('error');
        }

    }
}
