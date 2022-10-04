<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use App\Models\Organisation\EmployeeClass;
use App\Models\Users\Staff;
use Illuminate\Http\Request;

use App\Models\Leave\LeaveType;
use App\Models\Leave\LeaveEntitlement;
use App\Models\Leave\LeaveApplication;
use App\Models\Leave\LeaveStatus;
use App\Models\Organisation\Department;
use App\Models\Organisation\Section;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use App\DataTables\LeaveTypeDataTable;
use App\Models\Leave\StaffLeaveInformation;

use DateTime;
use Carbon\Carbon;

class LeaveController extends Controller
{
     public function export(LeaveTypeDataTable $dataTable)
    {
     return $dataTable->render('hrms.pages.leave.export');
    }

    public function index()
    {
        $leave = LeaveType::get()->toArray();
        $leaves_en = [];
        for($i=0;$i<count($leave);$i++){
         $leaves_en[$i]= LeaveEntitlement::where('leave_type_id',$leave[$i]["id"])
            ->leftJoin('employee_classes','leave_entitlements.employee_class_id','=','employee_classes.id')
            ->get()->toArray();
        }
         $classes = EmployeeClass::all();


        return view('pages.leave.leave_config',compact('leave','leaves_en','classes'));
    }

    public function leave_type_create(Request $request)
    {
      // dd($request->all());

        if($request->approval =='on'){
            $approve =1;
         }
         else{
              $approve =0;
         }

         if($request->annual_leave){
            $annual_leave =1;
         }
         else{
              $annual_leave = 0;
         }

        $leave_type = new LeaveType;
        $leave_type->leave_type_name = $request->name;
        $leave_type->leave_type_description = $request->description;
        $leave_type->require_approval = $approve;
        $leave_type->AnnuaL_Leave = $annual_leave;
        $leave_type->gender = $request->gender;
        $leave_type->save();

        for($i=0;$i<count($request->employee_class);$i++)
        {
            $entitlement = new LeaveEntitlement;
            $entitlement->leave_type_id = $leave_type->id;
            $entitlement->employee_class_id = $request->employee_class[$i];
            $entitlement->leave_availability = $request->availability;
            $entitlement->leave_entitlement = $request->entitlement;
            $entitlement->leave_eligibility = $request->eligibility;
            $entitlement->leave_carry_over = $request->carry;
            $entitlement->save();
        }

        return redirect()->route('hrms.leave')->with('success', 'New Leave Type Created Successfully');
    }

    public function delete_leave_type($id){

        LeaveType::find($id)->delete();

         return redirect()->route('hrms.leave')->with('success', 'Leave Type Deleted Successfully');
    }

    public function leave_type_update(Request $request,$id)
    {

         if($request->approval = 'on'){
            $approve =1;
         }
         else{
              $approve =0;
         }

        $leave_type = LeaveType::find($id);
        $leave_type->leave_type_name = $request->name;
        $leave_type->leave_type_description = $request->description;
        $leave_type->require_approval = $approve;
        $leave_type->gender = $request->gender;
        $leave_type->save();

        $flight = LeaveEntitlement::where('leave_type_id',$id);
        $flight->delete();

        for($i=0;$i<count($request->employee_class);$i++)
        {
            $entitlement = new LeaveEntitlement;
            $entitlement->leave_type_id = $leave_type->id;
            $entitlement->employee_class_id = $request->employee_class[$i];
            $entitlement->leave_availability = $request->availability;
            $entitlement->leave_entitlement = $request->entitlement;
            $entitlement->leave_eligibility = $request->eligibility;
            $entitlement->leave_carry_over = $request->carry;
            $entitlement->save();
        }

        return redirect()->route('hrms.leave')->with('success', 'New Leave Type Updated Successfully');
    }

    public function leave_application()
    {
        return view('pages.leave.leave_application');

    }
    public function leave_list()
    {
         $usr =  Auth::user()->id;
          $total_available = [];
         $applied = [];

        $application = LeaveApplication::with('leavestatus','leavetype','employee')->where('status_id',1)->get()->toArray();

        //dd($application);

        if(count($application)>0){


            for($i=0;$i<count($application);$i++){

                $leave_type = LeaveType::find($application[$i]["leavetype"]["id"]);

            $usr =  $application[$i]["user_id"];
            $class =  $application[$i]["employee"]["employee_class"];
            $leave = LeaveType::find($application[$i]["leavetype"]["id"]);
            $annual_leave = $leave->Annual_Leave;
            $now = Carbon::now();
            $taken = 0;
            $pending = 0;

            $entitlements = LeaveEntitlement::where([['employee_class_id',$class],['leave_type_id',$application[$i]["leavetype"]["id"]]])->first();
            //dd( $entitlements);
            $entitled=  $entitlements->leave_entitlement;

            $Takens = LeaveApplication::where([['user_id',$usr],['leave_type_id',$application[$i]["leavetype"]["id"]],['status_id',2]])
            ->get()->toArray();

            for($j=0;$j<count($Takens);$j++){

                $start = new carbon($Takens[$j]["start_date"]);
                $end = new carbon($Takens[$j]["end_date"]);
                $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                        return !$date->isWeekend();
                    },  $end);
                $taken = $taken + $count +1;
            }


            $pendings = LeaveApplication::where([['user_id',$usr],['leave_type_id',$application[$i]["leavetype"]["id"]],['status_id',2],['start_date','>',$now]])
            ->get()->toArray();

            for($k=0;$k<count($pendings);$k++){

                $start = new carbon($pendings[$k]["start_date"]);
                $end = new carbon($pendings[$k]["end_date"]);
                $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                        return !$date->isWeekend();
                    },  $end);
                $pending = $pending + $count +1;
            }

                if($leave_type->Annual_Leave==1){

                $con_start = Staff::where('id',$usr)->select('contract_start_date')->get()->toArray();
                $current_year = $now->year;
                $current_anniversary=new Carbon($con_start[0]["contract_start_date"]);
                $current_anniversary->setYear($current_year);
                $next_anniversary =  new Carbon($con_start[0]["contract_start_date"]);
                $next_anniversary->setYear($current_year);

                if($current_anniversary->greaterThanOrEqualTo($now)){
                    $current_anniversary->subYear();
                    $next_anniversary->subYear();
                }

                $next_anniversary->addYear();


                $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $now);

                $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                }, $next_anniversary);

                $entitlement = LeaveEntitlement::where('leave_type_id',$application[$i]["leavetype"]["id"])->first();


                $entitled=$entitlements->leave_entitlement;

                $ratio = $entitlements->leave_entitlement / $days_current_year;
                $CURRENT_ACCRUALS =  $days_after_anniversary *  $ratio;
                $CURRENT_ACCRUAL = round($CURRENT_ACCRUALS,1);

                $contract_start = new Carbon($con_start[0]["contract_start_date"]);
                $anniversary_year =$current_anniversary->year - $contract_start->year;

                $carry_overs = StaffLeaveInformation::where([['user_id',$usr],['anniversary_year',$anniversary_year]])->first();


                if($carry_overs != null){
                $carry_over = $carry_overs->new_leave - $entitlements->leave_entitlement;
                }else{
                     $carry_over = 0;
                }


                $total_accrued = $CURRENT_ACCRUAL + $carry_over ;


                $total_available[$i] = round($total_accrued - $taken,1) ;
                $start = new Carbon($application[$i]["start_date"]);
                $end = new Carbon($application[$i]["end_date"]);
                $applied[$i] = $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $end) + 1;




                }else{
                     $entitlements = LeaveEntitlement::where([['employee_class_id',$class],['leave_type_id',$application[$i]["leavetype"]["id"]]])->first();
                    $entitled=$entitlements->leave_entitlement;

                    $total_available[$i] = $entitled - $taken ;
                    $start = new Carbon($application[$i]["start_date"]);
                    $end = new Carbon($application[$i]["end_date"]);
                    $applied[$i] = $start->diffInDaysFiltered(function(Carbon $date) {
                        return !$date->isWeekend();
                    },  $end) + 1;

                }

            }
        }


         $statuses = LeaveStatus::find([2, 4]); ///get leave status for approved and disapprove

          $app = LeaveApplication::where('status_id','!=',['1','5'])
        //   ->with(['employee'=> function ($query) {
        //      $usr =  Auth::user()->id;
        //     $query->where('supervisor_id', $usr);
        // }])
        ->with('leavestatus','leavetype','employee')->get()->toArray();

        // $total_available = 0;
        // $applied = 0;
     // dd($application);
        return view('pages.leave.leave_list',compact('application','statuses','app','total_available','applied'));
    }

    public function leave_status_update(request $request, $id)
    {
        if($request->status == "true"){
             $status = 2;   // leave approved
        }else{
             $status = 4;   ///leave disapproved
        }

        LeaveApplication::where('id', $id)
          ->update(['status_id' => $status,'leave_application_review'=> $request->review ]);

        //   $details = [
        //     'greeting' => 'Hi Artisan',
        //     'body' => 'This is my first notification from ItSolutionStuff.com',
        //     'thanks' => 'Thank you for using ItSolutionStuff.com tuto!',
        //     'actionText' => 'View My Site',
        //     'actionURL' => url('/'),
        //     'order_id' => 101
        // ];


        return redirect()->route('hrms.leave_list')->with('success','Leave Status Updated Successfully');
    }

    public function leave_application_cancel($id)
    {
        //dd($id);

        $application = LeaveApplication::find($id);
        $application->status_id = 3;
        $application->save();

        return redirect()->route('hrms.leave_apply')->with('success','Leave Application Cancelled Successfully');

    }


    public function entitlements()
    {

        return view('pages.leave.entitlements');
    }

    public function entitlement_create(request $request)
    {

        $dates = explode(' - ', $request->date);
         $newDate[0] = \Carbon\Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
         $newDate[1] = \Carbon\Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');

        if($request->multiple_employee){
                if($request->department== -1){

                $employees = Staff::all()->toArray();

                for($i=0;$i<count($employees);$i++){
                    LeaveEntitlement::updateOrCreate(
                            ['Leave_Type_ID' => $request->leave, 'Employee_ID' => $employees[$i]["id"]],
                            ['Leave_Period_Start' => $newDate[0], 'Leave_Period_End' => $newDate[1],'Leave_Entitlement' => $request->days]
                        );
                    }
                }
                else{
                    $employees = Staff::where('department',$request->department)->get()->toArray();

                    for($i=0;$i<count($employees);$i++)
                    {
                        LeaveEntitlement::updateOrCreate(
                                ['Leave_Type_ID' => $request->leave, 'Employee_ID' => $employees[$i]["id"]],
                                ['Leave_Period_Start' => $newDate[0], 'Leave_Period_End' => $newDate[1],'Leave_Entitlement' => $request->days]
                            );
                    }
                }
            }
            else{
                $entitlement = LeaveEntitlement::updateOrCreate(
                                ['Leave_Type_ID' => $request->leave, 'Employee_ID' =>$request->employee],
                                ['Leave_Period_Start' => $newDate[0], 'Leave_Period_End' => $newDate[1],'Leave_Entitlement' => $request->days]
                            );

            }

        return redirect()->route('hrms.entitlements');
    }

    public function count_employee(request $request)
    {

        if($request->department!=-1){

            $numbers = Staff::where('department',$request->department)->get()->toArray();
            $number = count($numbers);
        }
        return Response($number);
    }

    public function leave_apply()
    {

        $usr =  Auth::user()->id;

        $leave_type = LeaveEntitlement::where('employee_class_id',Auth::user()->employee_class)
        ->leftJoin('leave_types','leave_entitlements.leave_type_id','=','leave_types.id')
        ->whereIn('leave_types.gender',['All', Auth::user()->gender])
        ->get()->toArray();


         $application = LeaveApplication::where('user_id',$usr)->with('leavetype')
         ->get()->toArray();

         $status = LeaveStatus::all();


        return view('pages.leave.leave_apply',compact('application','leave_type'));
    }


    public function leave_application_create(request $request)
    {
        $now = Carbon::now();

        //    $validation= Validator::make($request->all(), [
        //     'from' => 'required|date|after:now',
        //     'to' => 'required|date|after:'.$request->from
        //     ]);

        //     if ($validation->fails()) {
        //         return back()->with('error','Selected date is not valid');
        //         }

        $usr =  Auth::user()->id;
        // $con_start = Staff::where('id',$usr)->select('contract_start_date')->get()->toArray();

        // //change the date format to carbon
        //  $to_date = new Carbon($request->to);
        //  $from_date = new Carbon($request->from);
        //  $from =  new Carbon($request->from);
        //  $contract_start = new Carbon($con_start[0]["contract_start_date"]);
        //  $now = Carbon::now();
        //  $current_year = $now->year;
        //  $current_anniversary=new Carbon($con_start[0]["contract_start_date"]);
        //   $current_anniversary->setYear($current_year);
        //   $next_anniversary =  new Carbon($con_start[0]["contract_start_date"]);
        //  $next_anniversary->setYear($current_year);
        //   if($current_anniversary->greaterThanOrEqualTo($now)){
        //     $current_anniversary->subYear();
        //      $next_anniversary->subYear();
        //   }
        //  $next_anniversary->addYear();

        //  //days form start date of anniversary to today
        //  $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
        //     return !$date->isWeekend();
        // },  $from->subDay());
        // //days from start day of anniversary to end date of anniversary
        // $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
        //     return !$date->isWeekend();
        // }, $next_anniversary);

        // $entitlement = LeaveEntitlement::where('leave_type_id',$request->leave_type)
        // ->get()->toArray();

        // $ratio = $entitlement[0]["leave_entitlement"] / $days_current_year;
        // $available_leaves =  $days_after_anniversary *  $ratio;


        //  //calculate number of working days
        // $working_days = $from_date->diffInDaysFiltered(function(Carbon $date) {
        //     return !$date->isWeekend();
        // }, $to_date);

        // if($working_days > $available_leaves){
        //     return back()->with('error','You Do Not Have Sufficient Leaves');
        // }

        $approvals = LeaveType::where('id',$request->leave_type)->first();
         $status = $approvals->require_approval;

        $application = new LeaveApplication;
        $application->user_id =$usr;
        $application->leave_type_id = $request->leave_type;
        $application->start_date = $request->from;
        $application->end_date =$request->to;
        $application->leave_application_comment = $request->comment;
        $application->leave_application_review = "";

        if($request->file('document')){

           $application->leave_application_documents = $request->file('document')->store('document');
        }
        if($status==0){
           $application->status_id = 2;
        }else{
         $application->status_id = 1;
        }
        $application->save();

        return redirect()->route('hrms.leave_apply')->with('success','Applicaion Created Successfully');
    }

    public function entitlement_count(request $request)
    {
        $usr =  Auth::user()->id;
        $class =  Auth::user()->employee_class;
        $leave = LeaveType::find($request->leave);
        $annual_leave = $leave->Annual_Leave;
        $now = Carbon::now();
        $taken = 0;
        $pending = 0;

        $entitlements = LeaveEntitlement::where([['employee_class_id',$class],['leave_type_id',$request->leave]])->first();
        //dd( $entitlements);
        $entitled=  $entitlements->leave_entitlement;

        $Takens = LeaveApplication::where([['user_id',$usr],['leave_type_id',$request->leave],['status_id',2]])
        ->get()->toArray();

        for($i=0;$i<count($Takens);$i++){

            $start = new carbon($Takens[$i]["start_date"]);
            $end = new carbon($Takens[$i]["end_date"]);
            $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $end);
            $taken = $taken + $count +1;
        }


         $pendings = LeaveApplication::where([['user_id',$usr],['leave_type_id',$request->leave],['status_id',2],['start_date','>',$now]])
         ->get()->toArray();

        for($i=0;$i<count($pendings);$i++){

            $start = new carbon($pendings[$i]["start_date"]);
            $end = new carbon($pendings[$i]["end_date"]);
            $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $end);
            $pending = $pending + $count +1;
        }


        if($leave->Annual_Leave == 1){

                $con_start = Staff::where('id',$usr)->select('contract_start_date')->get()->toArray();
                $current_year = $now->year;
                $current_anniversary=new Carbon($con_start[0]["contract_start_date"]);
                $current_anniversary->setYear($current_year);
                $next_anniversary =  new Carbon($con_start[0]["contract_start_date"]);
                $next_anniversary->setYear($current_year);

                if($current_anniversary->greaterThanOrEqualTo($now)){
                    $current_anniversary->subYear();
                    $next_anniversary->subYear();
                }

                $next_anniversary->addYear();


                $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $now);

                $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                }, $next_anniversary);

                $entitlement = LeaveEntitlement::where('leave_type_id',$request->leave)->first();


                $entitled=$entitlements->leave_entitlement;

                $ratio = $entitlements->leave_entitlement / $days_current_year;
                $CURRENT_ACCRUALS =  $days_after_anniversary *  $ratio;
                $CURRENT_ACCRUAL = round($CURRENT_ACCRUALS,1);

                $contract_start = new Carbon($con_start[0]["contract_start_date"]);
                $anniversary_year =$current_anniversary->year - $contract_start->year;

                $carry_overs = StaffLeaveInformation::where([['user_id',$usr],['anniversary_year',$anniversary_year]])->first();


                if($carry_overs != null){
                $carry_over = $carry_overs->new_leave - $entitlements->leave_entitlement;
                }else{
                     $carry_over = 0;
                }


                $total_accrued = $CURRENT_ACCRUAL + $carry_over ;

                $total_available = round($total_accrued - $taken,1) ;

                 $response = array
                (
                'entitlement' => $entitled,
                'taken' => $taken,
                'pending' => $pending,
                'annual_leave' => $annual_leave,
                'carry_over' => $carry_over,
                'total_accrued' => $total_accrued,
                'total_available' => $total_available,
                'current_accrual' => $CURRENT_ACCRUAL,
                );


        }
        else
        {
            $entitlements = LeaveEntitlement::where([['employee_class_id',$class],['leave_type_id',$request->leave]])->first();
            $entitled=$entitlements->leave_entitlement;

            $total_available = $entitled - $taken ;

                $response = array
                (
                'entitlement' => $entitled,
                'taken' => $taken ,
                'pending' => $pending,
                'annual_leave' => $annual_leave,
                'total_available' => $total_available,
                );
        }



        return response()->json($response);
    }

    public function days_count(request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $from=new Carbon($from);
        $to=new Carbon($to);

         $days = $from->diffInDaysFiltered(function(Carbon $date) {
            return !$date->isWeekend();
        },  $to);

         $response = array(
          'days' => $days + 1,
      );

        return response()->json($response);
    }

     public function leave_history()
    {

        $usr =  Auth::user()->id;
        $class =  Auth::user()->employee_class;
        $leave = LeaveType::where('Annual_Leave',1)->first();
        //dd($leave);
        //$annual_leave = $leave->Annual_Leave;
        $now = Carbon::now();
        $taken = 0;
        $pending = 0;

        $entitlements = LeaveEntitlement::where([['employee_class_id',$class],['leave_type_id',$leave->id]])

        ->first();
        $entitled=$entitlements->leave_entitlement;

        $Takens = LeaveApplication::where([['user_id',$usr],['leave_type_id',$leave->id],['status_id',2]])
        ->get()->toArray();

        for($i=0;$i<count($Takens);$i++){

            $start = new carbon($Takens[$i]["start_date"]);
            $end = new carbon($Takens[$i]["end_date"]);
            $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $end);
            $taken = $taken + $count +1;
        }


         $pendings = LeaveApplication::where([['user_id',$usr],['leave_type_id',$leave->id],['status_id',2],['start_date','>',$now]])
         ->get()->toArray();

        for($i=0;$i<count($pendings);$i++){

            $start = new carbon($pendings[$i]["start_date"]);
            $end = new carbon($pendings[$i]["end_date"]);
            $count =  $start->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $end);
            $pending = $pending + $count +1;
        }


                $con_start = Staff::where('id',$usr)->select('contract_start_date')->get()->toArray();
                $current_year = $now->year;
                $current_anniversary=new Carbon($con_start[0]["contract_start_date"]);
                $current_anniversary->setYear($current_year);
                $next_anniversary =  new Carbon($con_start[0]["contract_start_date"]);
                $next_anniversary->setYear($current_year);

                if($current_anniversary->greaterThanOrEqualTo($now)){
                    $current_anniversary->subYear();
                    $next_anniversary->subYear();
                }

                $next_anniversary->addYear();


                $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },  $now);

                $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                }, $next_anniversary);

                $entitlement = LeaveEntitlement::where('leave_type_id',$leave->id)->first();

                $entitled=$entitlements->leave_entitlement;

                $ratio = $entitlements->leave_entitlement / $days_current_year;
                $CURRENT_ACCRUALS =  $days_after_anniversary *  $ratio;
                $CURRENT_ACCRUAL = round($CURRENT_ACCRUALS,1);

                $contract_start = new Carbon($con_start[0]["contract_start_date"]);
                $anniversary_year =$current_anniversary->year - $contract_start->year;

                $carry_overs = StaffLeaveInformation::where([['user_id',$usr],['anniversary_year',$anniversary_year]])->get()->toArray();
                 if(count($carry_overs)>0){
                    $carry_over = $carry_overs[0]["new_leaves"] - $entitlements->leave_entitlement;
                }else{
                    $carry_over = 0;
                }

                $total_accrued = $CURRENT_ACCRUAL + $carry_over ;
                $avail = $total_accrued - $taken;
                $total_available = round($avail,1) ;

                 $response = array
                (
                'entitlement' => $entitled,
                'taken' => $taken,
                'pending' => $pending,
                'carry_over' => $carry_over,
                'total_accrued' => $total_accrued,
                'total_available' => $total_available,
                'current_accrual' => $CURRENT_ACCRUAL,
                );

               // $leave = LEave

                //dd($response);


        $annual_leave = LeaveApplication::where([['user_id',$usr],['leave_type_id',$leave->id],['start_date','>=',$current_anniversary ],['end_date','<=',$next_anniversary]])->with('leavestatus')
        ->get()->toArray();

         $commited=[];

        // dd($annual_leave);

        if(count($annual_leave)>0){

                for($h=0;$h<count($annual_leave);$h++){
                    $S = new Carbon($annual_leave[$h]["start_date"]); //start date of leave
                    $E = new Carbon($annual_leave[$h]["end_date"]); // end date of leave

                    $commited[$h] = $S->diffInDaysFiltered(function(Carbon $date) {
                        return !$date->isWeekend();
                        },  $E) +1;

                }
            }
        //dd($annual_leave);

        return view('pages.leave.Leave_History',compact('response','annual_leave','commited'));
    }



    public function report(Request $request)
    {


         if(Request()->ajax())
        {
                if($request->type)
                {
                    $leave = LeaveType::find($request->type);

                    if($request->class > 0){
                        if($request->section > 0){
                            if($request->department > 0){
                                if($leave->gender != 'All' )
                                {
                                $staff = Staff::where([['employee_class',$request->class],['department',$request->department],['section',$request->section]])
                                ->where('gender',$leave->gender)
                                ->get()->toArray();
                                }else{
                                    $staff = Staff::where([['employee_class',$request->class],['department',$request->department],['section',$request->section]])
                                    ->get()->toArray();
                                }
                            }
                            else{
                                 if($leave->gender != 'All' )
                                {
                                    $staff = Staff::where([['employee_class',$request->class],['section',$request->section]])
                                    ->where('gender',$leave->gender)
                                    ->get()->toArray();
                                }else{
                                     $staff = Staff::where([['employee_class',$request->class],['section',$request->section]])
                                    ->get()->toArray();
                                }
                            }
                        }
                        else{

                            if($request->department > 0){
                                if($leave->gender != 'All' )
                                {
                                    $staff = Staff::where([['employee_class',$request->class],['department',$request->department]])
                                    ->where('gender',$leave->gender)
                                    ->get()->toArray();
                                }else{
                                    $staff = Staff::where([['employee_class',$request->class],['department',$request->department]])
                                    ->get()->toArray();
                                }
                            }
                            else{
                                if($leave->gender != 'All' )
                                {
                                     $staff = Staff::where('employee_class',$request->class)
                                    ->where('gender',$leave->gender)
                                    ->get()->toArray();
                                }
                                else{
                                     $staff = Staff::where('employee_class',$request->class)
                                    ->get()->toArray();
                                }

                            }

                            }
                    }
                    else{
                        if($request->section > 0){
                            if($request->department > 0){
                                 if($leave->gender != 'All' )
                                {
                                $staff = Staff::where([['department',$request->department],['section',$request->section]])
                                 ->where('gender',$leave->gender)
                                ->get()->toArray();
                                }else{
                                    $staff = Staff::where([['department',$request->department],['section',$request->section]])
                                    ->get()->toArray();
                                }
                            }
                            else{
                                 if($leave->gender != 'All' )
                                {
                                    $staff = Staff::where('section',$request->section)
                                    ->where('gender',$leave->gender)
                                    ->get()->toArray();
                                }else{
                                     $staff = Staff::where('section',$request->section)
                                    ->get()->toArray();
                                }
                            }
                        }
                        else{

                            if($request->department > 0){
                                  if($leave->gender != 'All' )
                                {
                                    $staff = Staff::where('department',$request->department)
                                    ->where('gender',$leave->gender)
                                    ->get()->toArray();
                                }else{
                                    $staff = Staff::where('department',$request->department)
                                     ->get()->toArray();
                                }
                            }
                            else{
                                if($leave->gender != 'All' )
                                {
                                   $staff = Staff:: where('gender',$leave->gender)
                                     ->get()->toArray();

                                }else{
                                    $staff = Staff::where('department',$request->department)
                                     ->get()->toArray();
                                }

                            }

                            }
                    }

                    if($leave->Annual_Leave == 1){

                        if(count($staff)>0){

                            $now = Carbon::now();

                            for($i=0;$i<count($staff);$i++)
                            {

                                $current_year = $now->year;

                                $entitlement = LeaveEntitlement::where([['leave_type_id',$request->type],['employee_class_id',$staff[$i]["employee_class"]]])
                                ->first();
                                // ->join('staff','leave_entitlements.employee_class_id','=','staff.employee_class')
                                // ->where('staff.id',$staff[$i]["id"])->get();

                                $entitled[$i] =  $entitlement->leave_entitlement;
                                $current_anniversary=new Carbon($staff[$i]["contract_start_date"]);
                                $current_anniversary->setYear($current_year);
                                $next_anniversary = new Carbon($staff[$i]["contract_start_date"]);
                                $next_anniversary->setYear($current_year);

                                if($current_anniversary->greaterThanOrEqualTo($now)){
                                    $current_anniversary->subYear();
                                    $next_anniversary->subYear();
                                }

                                $next_anniversary->addYear();

                                $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                                    return !$date->isWeekend();
                                },  $now);

                                $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                                    return !$date->isWeekend();
                                }, $next_anniversary);

                                $takens[$i] = LeaveApplication::where
                                ([['user_id','=',$staff[$i]["id"]],['leave_type_id','=',$leave->id],['status_id',2]])
                                ->whereDate('start_date','>=', $current_anniversary)->whereDate('end_date','<=', $next_anniversary)->get()->toArray();

                                $taken[$i]= count($takens[$i]);

                                $ratio = $entitled[$i] / $days_current_year;
                                $current_accruals=  $days_after_anniversary *  $ratio;
                                $current_accrual[$i] = round($current_accruals,1);

                                $contract_start = new Carbon($staff[$i]["contract_start_date"]);
                                $anniversary_year =$current_anniversary->year - $contract_start->year;

                                $carry_overs = StaffLeaveInformation::where([['user_id',$staff[$i]["id"]],['anniversary_year',$anniversary_year]])->get()->toArray();
                                if(count($carry_overs)>0){
                                    $carry_over[$i] = $carry_overs[0]["new_leaves"]-$entitled[$i];
                                }else{
                                    $carry_over[$i] = 0;
                                }

                                $total_accrued[$i] = $current_accrual[$i] + $carry_over[$i] ;

                                $total_available[$i] = round($total_accrued[$i] - $taken[$i],1) ;

                                $data[$i] = array
                                    (
                                        'name' =>$staff[$i]["name"],
                                        'username' =>$staff[$i]["username"],
                                        'entitlement' => $entitled[$i],
                                        'taken' => $taken[$i],
                                        'current_accrual' => $current_accrual[$i],
                                        'total_accrued' => $total_accrued[$i],
                                        'carried_over' => $carry_over[$i],
                                        'total_available' => $total_available[$i],
                                    );
                            }

                        }else
                        $data = [];

                      return datatables()->of($data)->make(true);
                    }
                    else
                    {

                        if(count($staff)>0){

                            $now = Carbon::now();

                        for($i=0;$i<count($staff);$i++){

                        $current_year = $now->year;
                        $current_anniversary=new Carbon($staff[$i]["contract_start_date"]);
                        $current_anniversary->setYear($current_year);
                        $next_anniversary = new Carbon($staff[$i]["contract_start_date"]);
                        $next_anniversary->setYear($current_year);

                        if($current_anniversary->greaterThanOrEqualTo($now)){
                            $current_anniversary->subYear();
                            $next_anniversary->subYear();
                        }

                        $next_anniversary->addYear();

                        $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isWeekend();
                        },  $now);

                        $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isWeekend();
                        }, $next_anniversary);

                        $takens[$i] = LeaveApplication::where
                        ([['user_id','=',$staff[$i]["id"]],['leave_type_id','=',$leave->id],['status_id',2]])
                        ->whereDate('start_date','>=', $current_anniversary)->whereDate('end_date','<=', $next_anniversary)->get()->toArray();

                        $taken[$i]= count($takens[$i]);


                        $entitlement = LeaveEntitlement::where([['leave_type_id',$request->type],['employee_class_id',$staff[$i]["employee_class"]]])
                                ->first();
                                $entitled[$i] = $entitlement->leave_entitlement;

                        $available[$i] = $entitled[$i]-$taken[$i] ;

                                $data[$i] = array
                                (
                                    'name' =>$staff[$i]["name"],
                                    'username' =>$staff[$i]["username"],
                                    'entitlement' =>  $entitled[$i],
                                    'taken' =>$taken[$i],
                                    'total_available' => $available[$i],
                                );
                            }
                        }else
                        $data = [];

                            return datatables()->of($data)->make(true);
                    }

                }
                elseif($request->employee_class){

                    if($request->employee_class > 0){

                    //    $leave_type = LeaveType::join('leave_entitlements','leave_types.id','=','leave_entitlements.leave_type_id')
                    //     ->join('employee_classes','leave_entitlements.employee_class_id','=','employee_classes.id')
                    //     ->where('employee_classes.id',$request->employee_class)
                    //     ->get();
                        //  dd($leave_type);
                        $leave_type = EmployeeClass::join('leave_entitlements','employee_classes.id','=','leave_entitlements.employee_class_id')
                        ->join('leave_types','leave_entitlements.leave_type_id','=','leave_types.id')
                         ->where('employee_classes.id',$request->employee_class)
                        ->get();

                        return response()->json($leave_type);


                    }else{

                        $leave_type = LeaveType::get();

                        return response()->json($leave_type);
                    }
                }
                elseif($request->sections){

                    if($request->sections > 0){

                       $department = Section::join('departments','sections.id','=','departments.section_id')
                       ->where('sections.id',$request->sections)
                        ->get();

                        return response()->json($department);


                    }else{

                        $department = Section::join('departments','sections.id','=','departments.section_id')
                        ->get();

                        return response()->json($department);
                    }
                }
                else{

                    $staff = [];

                    $staff = LeaveType::where('leave_types.Annual_Leave',1)
                    ->rightJoin('leave_entitlements','leave_types.id','=','leave_entitlements.leave_type_id')
                    ->rightJoin('employee_classes','leave_entitlements.employee_class_id','=','employee_classes.id')
                    ->rightJoin('staff','employee_classes.id','=','staff.employee_class')
                    ->get()->toArray();

                    $now = Carbon::now();

                    $data = [];

                    for($i=0;$i<count($staff);$i++)
                    {

                        $current_year = $now->year;
                        $entitled[$i] =  $staff[$i]["leave_entitlement"];
                        $current_anniversary=new Carbon($staff[$i]["contract_start_date"]);
                        $current_anniversary->setYear($current_year);
                        $next_anniversary = new Carbon($staff[$i]["contract_start_date"]);
                        $next_anniversary->setYear($current_year);

                        if($current_anniversary->greaterThanOrEqualTo($now)){
                            $current_anniversary->subYear();
                            $next_anniversary->subYear();
                        }

                        $next_anniversary->addYear();

                        $days_after_anniversary = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isWeekend();
                        },  $now);

                        $days_current_year = $current_anniversary->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isWeekend();
                        }, $next_anniversary);

                        $takens[$i] = LeaveApplication::where
                        ([['user_id','=',$staff[$i]["id"]],['leave_type_id','=',$staff[$i]["leave_type_id"]],['status_id',2]])
                        ->whereDate('start_date','>=', $current_anniversary)->whereDate('end_date','<=', $next_anniversary)->get()->toArray();

                        $taken[$i]= count($takens[$i]);

                        $ratio = $staff[$i]["leave_entitlement"] / $days_current_year;
                        $current_accruals=  $days_after_anniversary *  $ratio;
                        $current_accrual[$i] = round($current_accruals,1);

                        $contract_start = new Carbon($staff[$i]["contract_start_date"]);
                        $anniversary_year =$current_anniversary->year - $contract_start->year;

                        $carry_overs = StaffLeaveInformation::where([['user_id',$staff[$i]["id"]],['anniversary_year',$anniversary_year]])->get()->toArray();
                        if(count($carry_overs)>0){
                            $carry_over[$i] = $carry_overs[0]["new_leaves"]-$staff[$i]["leave_entitlement"];
                        }else{
                            $carry_over[$i] = 0;
                        }

                        $total_accrued[$i] = $current_accrual[$i] + $carry_over[$i] ;

                        $total_available[$i] = round($total_accrued[$i] - $taken[$i],1) ;

                        $data[$i] = array
                            (
                                'name' =>$staff[$i]["name"],
                                'username' =>$staff[$i]["username"],
                                'entitlement' => $entitled[$i],
                                'taken' => $taken[$i],
                                'current_accrual' => $current_accrual[$i],
                                'total_accrued' => $total_accrued[$i],
                                'carried_over' => $carry_over[$i],
                                'total_available' => $total_available[$i],
                            );
                    }

                    return datatables()->of($data)->make(true);

                }
        }

             $type = LeaveType::all();
             $employee_class = EmployeeClass::all();
             $employee = Staff::all();
             $department = Department::all();
             $section = Section::all();

             $leave_applied = count(LeaveApplication::all());
              $now = Carbon::now();
             $staff_leave = count(LeaveApplication::where([['start_date','>=',$now],['end_date','<=',$now],['status_id','2']])->get()->toArray());

             $pending = count(LeaveApplication::where('status_id','2')->get()->toArray());

             //dd($pending);

        return view('pages.leave.report',compact('type','employee_class','employee','department','section','leave_applied',
        'staff_leave','pending'
     ));
    }

}
