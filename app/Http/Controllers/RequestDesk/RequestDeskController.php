<?php

namespace App\Http\Controllers\RequestDesk;

use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use App\Models\RequestService\RSCategories;
use App\Models\RequestService\RSClosureCode;
use App\Models\RequestService\RSPriority;
use App\Models\RequestService\RSRequest;
use App\Models\RequestService\RSStatus;
use App\Models\User;
use App\Models\Users\Staff;
use Illuminate\Http\Request;
use App\Mail\RequestDeskMail;
use App\Models\RequestService\RSCategoryTechnicians;

use Illuminate\Support\Facades\Mail;





use Illuminate\Support\Facades\Auth;

class RequestDeskController extends Controller
{
    public function request_config()
    {

            $types = RSCategories::get()->toArray();

            $technicians = [];

            for($i=0;$i<count($types);$i++){

                $technicians[$i] = RSCategoryTechnicians::where('category_id',$types[$i]["id"])
                ->join('staff','r_s_category_technicians.user_id','=','staff.id')
                ->get()->toArray();
            }


            $users = Staff::all()->toArray();

        return view('pages.RequestDesk.RequestDeskConfig',compact('types','technicians','users'));
    }

    public function Employee_request()
    {

        $service = RSRequest::with('requester','status','category','technician','priority','closure')->get()->toArray();
        $status = RSStatus::get()->toArray();
        $code = RSClosureCode::get()->toArray();
        $category = RSCategories::get()->toArray();
       // dd($service);

        return view('pages.RequestDesk.Employee_request',compact('service','status','code','category'));
    }

     public function request()
    {

        $service = RSRequest::where('requester_id',Auth::user()->id)->with('status','category','priority')
        ->get()->toArray();

        //dd($service);

        $priority = RSPriority::all();
        $category = RSCategories::all();

        //dd($service);

        return view('pages.RequestDesk.request',compact('priority','category','service'));
    }

    public function request_create(request $request)
    {

         $usr =  Auth::user()->id;

        $service = new RSRequest;
        $service->requester_id = $usr;
        $service->category_id = $request->category;
        $service->priority_id = $request->priority;
        $service->request_subject = $request->subject;
        $service->request_description = $request->description;
         if($request->file('attachment')){
           $service->request_attachment = $request->file('attachment')->store('attachment');
        }
        $service->request_status_id = 2;
        $service->request_created = \Carbon\Carbon::now();
        $service->save();


        $priority = RSPriority::all();
        $category = RSCategories::all();

         return redirect()->route('hrms.request')->with('success', 'Request Created Successfully');
    }

    public function request_update(request $request,$id)
    {

        //dd($request->all());
         //$usr =  Auth::user()->id;

        $service = RSRequest::find($id);
        $service->category_id = $request->category;
        $service->priority_id = $request->priority;
        $service->request_subject = $request->subject;
        $service->request_description = $request->description;
         if($request->file('attachment')){
           $service->request_attachment = $request->file('attachment')->store('attachment');
        }
        $service->request_status_id = 2;
        $service->request_created = \Carbon\Carbon::now();
        $service->save();

         return redirect()->route('hrms.request')->with('success', 'Request Updated Successfully');
    }

    public function request_status_update(request $request)
    {
        if($request->status == 3){

          RSRequest::where('id', $request->service)
          ->update(['request_status_id' => $request->status]);

          $service = RSRequest::find($request->service);

          $technician = RSCategoryTechnicians::where('category_id', $service->category_id)
          ->join('staff','r_s_category_technicians.user_id','=','staff.id')
          ->get()->toArray();

           for($i=0;$i<count($technician);$i++){

            Mail::to($technician[$i]["email"])->send(new NotifyMail());

           }
        }else{

            RSRequest::where('id', $request->service)
            ->update(['request_status_id' => $request->status]);
        }
        return response()->json();
    }
    public function close_request(request $request,$id)
    {
        if($request->resolution){

            RSRequest::where('id', $id)
            ->update(['request_resolution'=> $request->resolution,'request_status_id'=> 4]);

        }else{
            if($request->status == true){
                $ack = 1;
            }else
                $ack = 0;

            RSRequest::where('id', $id)
            ->update(['request_closed' => \Carbon\Carbon::now() ,'requester_acknowledgemnt'=> $ack ,'requester_comment'=> $request->Comment,'closure_code_id'=> $request->name,'request_closure_comment'=> $request->Closure_Comments,'request_status_id'=> 1]);
        }

         return back()->with('success','Status Updated Successfully');
    }

    public function request_type_create(request $request)
    {

        // dd($request->all());
        $category = new RSCategories;
        $category->request_category_name = $request->request_type;
        $category->save();

        for($i=0;$i<count($request->assigned);$i++){

            $technician = new RSCategoryTechnicians;
            $technician->category_id = $category->id;
            $technician->user_id = $request->assigned[$i];
            $technician->save();

        }

         return redirect()->route('hrms.request_config');

    }

    public function request_type_update(request $request,$id)
    {

        RSCategories::where('id', $id)
          ->update(['request_category_name' => $request->request_type]);

        if(count($request->assigned)>0){

          RSCategoryTechnicians::where('category_id', $id)->delete();

           for($i=0;$i<count($request->assigned);$i++){

            $technician = new RSCategoryTechnicians;
            $technician->category_id = $id;
            $technician->user_id = $request->assigned[$i];
            $technician->save();

            }

        }

         return redirect()->route('hrms.request_config');

    }

    public function Technicians_request()
    {
        $usr = Auth::user()->id;

         $dash = RSRequest::join('r_s_category_technicians','r_s_requests.category_id','=','r_s_category_technicians.category_id')
        ->where('r_s_category_technicians.user_id',$usr)
        ->with('status','category','priority','requester')
        ->select('r_s_requests.*')
        ->get()->toArray();

        // $dash = RSCategoryTechnicians::join('r_s_requests','r_s_category_technicians.category_id','=','r_s_requests.category_id')
        // ->where('r_s_category_technicians.user_id',$usr)
        // ->with('requests.status','requests.category','requests.priority','requests.requester')
        // ->get()->toArray();


       // dd($dash);

        $status = RSStatus::where('id','!=','2')->get()->toArray();
        $code = RSClosureCode::get()->toArray();
        $category = RSCategories::get()->toArray();

       //dd($dash);
        return view('pages.RequestDesk.technician',compact('dash','status','code','category'));
    }

    public function request_types_update(request $request)
    {

        RSRequest::where('id', $request->service)
          ->update(['category_id' => $request->type]);

          return response()->json();
    }

    public function request_cancel($id)
    {

      $service = RSRequest::find($id);
      $service->request_status_id = 1;
       $service->closure_code_id = 1;
       $service->save();

          return back()->with('success','Request Cancelled Successfully');
    }


    public function sendmail()
    {

        Mail::to('shoneelkumar@gmail.com')->send(new NotifyMail());

      if (Mail::failures()) {
           return response()->Fail('Sorry! Please try again latter');
      }else{
           return response()->success('Great! Successfully send in your mail');
         }

    }

    public function request_type_delete($id){

        $type = RSCategories::find($id);
        $type->delete();

         return redirect()->route('hrms.request_config');

    }
}
