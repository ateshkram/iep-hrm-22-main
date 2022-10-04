<?php

namespace App\Http\Controllers\DisciplinaryTracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\Staff;
use App\Models\DisciplinaryCase\DCLevel;
use App\Models\DisciplinaryCase\DCUserLevel;
use App\Models\DisciplinaryCase\DCCategories;
use App\Models\DisciplinaryCase\DCStatus;
use App\Models\DisciplinaryCase\DCCommittee;
use App\Models\DisciplinaryCase\DCActivityLogs;
use App\Models\DisciplinaryCase\DCClosureCode;
use App\Models\DisciplinaryCase\DisciplinaryCase;
use App\Models\DisciplinaryCase\DCCategoryTechnicians;
use App\Models\DisciplinaryCase\DCCommitteeTechnicians;

//temporary
use App\Models\RequestService\RSCategories;
use App\Models\RequestService\RSClosureCode;
use App\Models\RequestService\RSPriority;
use App\Models\RequestService\RSRequest;
use App\Models\RequestService\RSStatus;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class DisciplinaryCaseController extends Controller
{

    public function disciplinary_config()
    {
        $types = DCCategories::get()->toArray();

        $committee = DCCommittee::get()->toArray();

        $technicians = [];

        for($i=0;$i<count($types);$i++){
            $technicians[$i] = DCCategoryTechnicians::where('category_id',$types[$i]["id"])
            ->join('d_c_committee', 'd_c_category_technicians.committee_id', '=', 'd_c_committee.id')
            ->get()->toArray();
        }

        $committees = [];

        for($i=0;$i<count($types);$i++){
            $committees[$i] = DCCategoryTechnicians::where('category_id',$types[$i]["id"])
            ->join('d_c_committee', 'd_c_category_technicians.committee_id', '=', 'd_c_committee.id')
            ->get()->unique('committee_id')->values()->toArray();
        }

        $users = Staff::all()->toArray();

        return view('pages.DisciplinaryTracker.DisciplinaryCaseConfig',compact('types','technicians','users', 'committee', 'committees'));

    }

    public function disciplinary_type_create(request $request)
    {

        
        // dd($request->all());
        $category = new DCCategories;
        $category->disciplinary_category_name = $request->d_c_type;
        $category->disciplinary_category_description = $request->d_c_description;
        $category->disciplinary_category_tolerance = $request->d_c_tolerance;
        $category->save();
        
        $val = $request->assigned;

        //return $val;

        for($i=0;$i<count($request->assigned);$i++){
            $committee = DCCommitteeTechnicians::whereIn('committee_id', $val)
                        ->get()->toArray();
        }
  
        for ($i=0; $i<count($committee); $i++){

             $technician = new DCCategoryTechnicians;
             $technician->category_id = $category->id;
             $technician->committee_id = $committee[$i]["committee_id"];
             $technician->save();

        }

        //return $committee;

        return redirect()->route('hrms.disciplinary_config');

    }

    public function disciplinary_type_update(request $request,$id)
    {

        DCCategories::where('id', $id)
          ->update([
            'disciplinary_category_name' => $request->d_c_category,
            'disciplinary_category_description' => $request->d_c_description,
            'disciplinary_category_tolerance' => $request->d_c_tolerance
        ]);

        if(count($request->assigned)>0){

          DCCategoryTechnicians::where('category_id', $id)->delete();

           for($i=0;$i<count($request->assigned);$i++){

            $technician = new DCCategoryTechnicians;
            $technician->category_id = $id;
            $technician->committee_id = $request->assigned[$i];
            $technician->save();

            }

        }

         return redirect()->route('hrms.disciplinary_config');

    }

    public function disciplinary_type_delete($id)
    {

        $technician = DCCategoryTechnicians::where('category_id', $id)->delete();
        $case = DisciplinaryCase::where('category_id', $id)->get();
        $alog = $case->pluck('id')->toArray();
        $activity = DCActivityLogs::whereIn('case_id', $alog)->delete();
        $case = DisciplinaryCase::where('category_id', $id)->delete();
        $type = DCCategories::find($id);
        $type->delete();

        return redirect()->route('hrms.disciplinary_config');

    }

    public function disciplinary_committee()
    {
        $committee = DCCommittee::get()->toArray();

        $technicians = [];

        for($i=0;$i<count($committee);$i++){

            $technicians[$i] = DCCommitteeTechnicians::where('committee_id',$committee[$i]["id"])
            ->join('staff','d_c_committee_technicians.user_id','=','staff.id')
            ->get()->toArray();
        }


        $users = Staff::all()->toArray();

        return view('pages.DisciplinaryTracker.DisciplinaryCaseCommittee',compact('committee','technicians','users'));

    }

    public function disciplinary_committee_create(request $request)
    {
        $committee = new DCCommittee;
        $committee->disciplinary_committee_name = $request->committee;
        $committee->save();

        for($i=0;$i<count($request->assigned);$i++){

            $technician = new DCCommitteeTechnicians;
            $technician->committee_id = $committee->id;
            $technician->user_id = $request->assigned[$i];
            $technician->save();

        }

        return redirect()->route('hrms.disciplinary_committee');
    }

    public function disciplinary_committee_update(request $request,$id)
    {

        DCCommittee::where('id', $id)
          ->update([
            'disciplinary_committee_name' => $request->d_c_committee,
        ]);

        if(count($request->assigned)>0){

          DCCommitteeTechnicians::where('committee_id', $id)->delete();

           for($i=0;$i<count($request->assigned);$i++){

            $technician = new DCCommitteeTechnicians;
            $technician->committee_id = $id;
            $technician->user_id = $request->assigned[$i];
            $technician->save();

            }

        }

         return redirect()->route('hrms.disciplinary_committee');

    }

    public function disciplinary_committee_delete($id)
    {
        $technicians_cat = DCCategoryTechnicians::where('committee_id', $id)->get();
        $technicians_cat->pluck('category_id')->toArray();
        $technicians_comm = DCCommitteeTechnicians::where('committee_id', $id)->delete();
        $technicians = DCCategoryTechnicians::where('committee_id', $id)->delete();
        $category = DCCategories::whereIn('id', $technicians_cat)->delete();
        $committee = DCCommittee::findorFail($id)->delete();

        return redirect()->route('hrms.disciplinary_committee');

    }

    public function disciplinary_case()
    {
        $service = RSRequest::where('requester_id',Auth::user()->id)->with('status','category','priority')
        ->get();

        //dd($service);

        $case = DisciplinaryCase::all();

        //$offender = Staff::where('id', $case->user_id)->get();

        $priority = RSPriority::all();
        $category = DCCategories::all();

        $user = Staff::all();

        //dd($service);

        return view('pages.DisciplinaryTracker.DisciplinaryCaseDash',compact('case', 'priority','category','service', 'user'));

    }

    public function disciplinary_case_create(Request $request)
    {
      
        $disciplinaryCase = new DisciplinaryCase;
        $disciplinaryCase->user_id = $request->users;
        $disciplinaryCase->category_id = $request->category;
        $disciplinaryCase->case_subject = $request->subject;
        $disciplinaryCase->case_description = $request->description;
        $disciplinaryCase->case_severity = $request->severity;
        if($request->hasFile('attachment'))
        {
            $file = $request->file('attachment')->store('attachment');
            $disciplinaryCase->case_attachment = $file;
        }
        $disciplinaryCase->case_created_date = $request->created_date;
        $disciplinaryCase->case_created_time = $request->created_time;
        $disciplinaryCase->case_created_comments = $request->comments;
        $disciplinaryCase->case_status_id = 3;
        $disciplinaryCase->save();

        $activity = new DCActivityLogs;
        $activity->case_id = $disciplinaryCase->id;
        $activity->user_id = Auth::user()->id;
        $activity->description = 
        "Created a ".$disciplinaryCase->category->disciplinary_category_name." Disciplinary Case for "
        .$disciplinaryCase->staff->name;
        $activity->save();

        return redirect()->route('hrms.disciplinary_case');

    }

    public function disciplinary_case_cancel($id)
    {
        $case = DisciplinaryCase::find($id);
        $case->case_status_id = 1;
        $status = DCClosureCode::find(1);
        $case->case_closure_date = date('Y-m-d', strtotime($case->updated_at));
        $case->case_closure_time = date('H:i:s', strtotime($case->updated_at));
        $case->case_closure_comments = $status->code_name;     
        $case->closure_code_id = 1;
        $case->save();

        $activity = new DCActivityLogs;
        $activity->case_id = $id;
        $activity->user_id = Auth::user()->id;
        $activity->description = "Cancelled the Disciplinary Case for ".$case->staff->name;
        $activity->save();

        return redirect()->route('hrms.disciplinary_case');
    }

    public function disciplinary_desk()
    {
        $service = RSRequest::where('requester_id',Auth::user()->id)->with('status','category','priority')
        ->get();

        $user_id = Auth::user()->id;

        $committee = DCCommitteeTechnicians::where('user_id', $user_id)
                    ->get()->pluck('committee_id')->toArray();
        
        $category = DCCategoryTechnicians::whereIn('committee_id', $committee)
                    ->get()->pluck('category_id')->toArray();

        $case = DisciplinaryCase::whereIn('category_id', $category)
                    ->get();

        $usr = $case->pluck('user_id')->toArray();

        $level = DCUserLevel::whereIn(
                    'user_id', 
                    $usr
                    )->latest()->get()->unique('user_id')->values()->toArray();
                    
        $case->toArray();
                                         
        $priority = RSPriority::all();
        $category = DCCategories::all();
        $status = DCStatus::all();

        $user = Staff::all();

        $code = DCClosureCode::all();

        $warning = DCUserLevel::where('disciplinary_case_level_id', 1)->count();
        $suspension = DCUserLevel::where('disciplinary_case_level_id', 2)->count();
        $termination = DCUserLevel::where('disciplinary_case_level_id', 3)->count();

        $state = ["warning" => $warning, "suspension" => $suspension, "termination" => $termination];

        return view('pages.DisciplinaryTracker.DisciplinaryCaseDesk',compact(
            'case',
            'level', 
            'priority',
            'category',
            'code',
            'service', 
            'user', 
            'status', 
            'state'
        ));

    }

    public function disciplinary_desk_warning($id)
    {

        $case = DisciplinaryCase::find($id); $usr = $case->user_id;

        try {
            $userLevel = DCUserLevel::with('disciplinary_case_level')
            ->where('user_id', $usr)->latest('d_c_user_level.created_at')
            ->get()->first();
        }
        catch(\ModelNotFoundException $exception){

            return redirect()->back();

        }

        /*
        * Constants
        */
        $levelVal = 1;
        $levelId = 1; //hardcoding level id for warning
        
        if(empty($userLevel)){

            $level = new DCUserLevel;
            $level->user_id = $usr;
            $level->disciplinary_case_level_id = $levelId;
            $level->level_count = $levelVal;
            $level->save();

            $activity = new DCActivityLogs;
            $activity->case_id = $id;
            $activity->user_id = Auth::user()->id;
            $activity->description = "Issued a Level 1 Warning to the Disciplinary Case for ".$case->staff->name;
            $activity->save();

            return redirect()->route('hrms.disciplinary_desk');
           
        }

        $levelMax = $userLevel->disciplinary_case_level->level_max;
        $levelId = $userLevel->disciplinary_case_level->id;

        try{
            if ($userLevel->level_count < $levelMax)
            {
                $count = $userLevel->level_count + $levelVal;

                $level = new DCUserLevel;
                $level->user_id = $usr;
                $level->disciplinary_case_level_id = $levelId;
                $level->level_count = $count;
                $level->save();

                if($count == 2)
                {
                    $activity = new DCActivityLogs;
                    $activity->case_id = $id;
                    $activity->user_id = Auth::user()->id;
                    $activity->description = "Escalated Warning to Level 2 to the Disciplinary Case for ".$case->staff->name;
                    $activity->save();
                }

                if($count == 3)
                {
                    $activity = new DCActivityLogs;
                    $activity->case_id = $id;
                    $activity->user_id = Auth::user()->id;
                    $activity->description = "Escalated Warning to Level 3 to the Disciplinary Case for ".$case->staff->name;
                    $activity->save();
                }
              
            }

            else
            {
                return redirect()->back(); //Call to class suspend
            }
        }
        catch(\Exception $e){

            return redirect()->back();

        }
        
        return redirect()->route('hrms.disciplinary_desk');

    }

    public function disciplinary_desk_suspend($id)
    {

        $case = DisciplinaryCase::find($id); $usr = $case->user_id;

        try {
            $userLevel = DCUserLevel::with('disciplinary_case_level')
            ->where('user_id', $usr)->latest('d_c_user_level.created_at')
            ->get()->first();
        }
        catch(\ModelNotFoundException $exception){

            return redirect()->back();

        }

        /*
        * Constants
        */
        $levelVal = 1;
        $levelId = 2; //hardcoding level id for warning
        
        if(empty($userLevel)){

            $level = new DCUserLevel;
            $level->user_id = $usr;
            $level->disciplinary_case_level_id = $levelId;
            $level->level_count = $levelVal;
            $level->save();

            $activity = new DCActivityLogs;
            $activity->case_id = $id;
            $activity->user_id = Auth::user()->id;
            $activity->description = "Issued a Level 1 Suspension to the Disciplinary Case for ".$case->staff->name;;
            $activity->save();

            return redirect()->route('hrms.disciplinary_desk');
           
        }

        $levelMax = $userLevel->disciplinary_case_level->level_max;
        //$levelId = $userLevel->disciplinary_case_level->id;
        $levelW = 1;

        try{
            if ($userLevel->disciplinary_case_level_id ==  $levelW)
            {
                $count = $levelVal;

                $level = new DCUserLevel;
                $level->user_id = $usr;
                $level->disciplinary_case_level_id = $levelId;
                $level->level_count = $count;
                $level->save();

                $activity = new DCActivityLogs;
                $activity->case_id = $id;
                $activity->user_id = Auth::user()->id;
                $activity->description = "Escalated Warning to Level 1 Suspension to the Disciplinary Case for ".$case->staff->name;
                $activity->save();
              
            }

            else if ($userLevel->level_count < $levelMax)
            {
                $count = $userLevel->level_count + $levelVal;

                $level = new DCUserLevel;
                $level->user_id = $usr;
                $level->disciplinary_case_level_id = $levelId;
                $level->level_count = $count;
                $level->save();

                $activity = new DCActivityLogs;
                $activity->case_id = $id;
                $activity->user_id = Auth::user()->id;
                $activity->description = "Escalated Suspension to Level 2 to the Disciplinary Case for ".$case->staff->name;
                $activity->save();

            }

            else
            {
                return redirect()->back(); //Call to class suspend
            }
        }
        catch(\Exception $e){

            return redirect()->back();

        }
        
        return redirect()->route('hrms.disciplinary_desk');

    }

    public function disciplinary_desk_terminate($id)
    {

        $case = DisciplinaryCase::find($id); $usr = $case->user_id;

        try {
            $userLevel = DCUserLevel::with('disciplinary_case_level')
            ->where('user_id', $usr)->latest('d_c_user_level.created_at')
            ->get()->first();
        }
        catch(\ModelNotFoundException $exception){

            return redirect()->back();

        }

        /*
        * Constants
        */
        $levelVal = 1;
        $levelId = 3; //hardcoding level id for termination
        
        if(empty($userLevel)){

            $level = new DCUserLevel;
            $level->user_id = $usr;
            $level->disciplinary_case_level_id = $levelId;
            $level->level_count = $levelVal;
            $level->save();

            $activity = new DCActivityLogs;
            $activity->case_id = $id;
            $activity->user_id = Auth::user()->id;
            $activity->description = "Issued Termination to Disciplinary Case";
            $activity->save();

            return redirect()->route('hrms.disciplinary_desk');
           
        }

        $levelMax = $userLevel->disciplinary_case_level->level_max;

        if($userLevel->disciplinary_case_level->id == $levelId)
        {
            return redirect()->back();
        }

        else 
        {
            try
            {
                $count = $levelVal;

                $level = new DCUserLevel;
                $level->user_id = $usr;
                $level->disciplinary_case_level_id = $levelId;
                $level->level_count = $count;
                $level->save();

                $activity = new DCActivityLogs;
                $activity->case_id = $id;
                $activity->user_id = Auth::user()->id;
                $activity->description = "Issued a Level 1 Termination to the Disciplinary Case for ".$case->staff->name;;
                $activity->save();
                
            }
            
            catch(\Exception $e){

                return redirect()->back();

            }

        }
                
        return redirect()->route('hrms.disciplinary_desk');

    }

    public function case_status_update(request $request)
    {
        //$status = DisciplinaryCase::where('id', $request->case)->get();

        $activity = new DCActivityLogs;
        $activity->case_id = $request->case;
        $activity->user_id = Auth::user()->id;
        //$activity->description = "Updated the Status to ".$status->status->status_name." to the Disciplinary Case for ".$status->staff->name;
        $activity->description = "Updated the Status to the Disciplinary Case";

        $activity->save();

        DisciplinaryCase::where('id', $request->case)
        ->update(['case_status_id' => $request->status]);
                
        return response()->json();
    }
    
    public function case_close(request $request,$id)
    {
        $closed = 1;
       
        DisciplinaryCase::where('id', $id)
        ->update(
            [
                'case_status_id' => $closed,
                'case_closure_date' => $request->closed_date,
                'case_closure_time' => $request->closed_time,
                'case_closure_comments' => $request->comments,
                'closure_code_id' => $request->code
            ]);
        
            $activity = new DCActivityLogs;
            $activity->case_id = $id;
            $activity->user_id = Auth::user()->id;
            $activity->description = "Closed Disciplinary Case";
            $activity->save();

         return back()->with('success','Status Updated Successfully');
    }

    public function disciplinary_details($id) 
    {
        $case = DisciplinaryCase::find($id);
        $category = DCCategoryTechnicians::where('category_id', $case->category_id)
                    ->get();

        $comm = $category->pluck('committee_id')->toArray();
        $committee = DCCommitteeTechnicians::where('committee_id', $comm)->get()
                    ->unique('committee_id')->values();

        $staff = Staff::all();

        $activity = DCActivityLogs::where('case_id', $id)->get();

        return view('pages.DisciplinaryTracker.DisciplinaryCaseDetails',compact(
            'case',
            'committee',
            'category',
            'staff',
            'activity'
        ));
    }

    public function my_disciplinary_case()
    {
        $usr = Auth::user()->id;
        $case = DisciplinaryCase::where('user_id', $usr)->get();

        $category = DCCategories::all();

        $warning = DCUserLevel::where('user_id', $usr)->where('disciplinary_case_level_id', 1)->count();
        $suspension = DCUserLevel::where('user_id', $usr)->where('disciplinary_case_level_id', 2)->count();
        $termination = DCUserLevel::where('user_id', $usr)->where('disciplinary_case_level_id', 3)->count();

        $status = DCStatus::all();

        $state = ["warning" => $warning, "suspension" => $suspension, "termination" => $termination];

        return view('pages.DisciplinaryTracker.DisciplinaryCaseMy',compact(
            'case',
            'state',
            'category',
            'status'
        ));
    }

}
