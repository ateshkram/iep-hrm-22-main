<?php

namespace App\Models\Leave;

use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    public function leavetype(){
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }

    public function leavestatus(){
        return $this->belongsTo(LeaveStatus::class,'status_id');
    }

    public function employee(){
        return $this->belongsTo(Staff::class,'user_id');
    }
}
