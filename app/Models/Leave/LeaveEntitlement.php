<?php

namespace App\Models\Leave;

use App\Models\EmployeeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveEntitlement extends Model
{
    use HasFactory;

    public function leavetype(){
        return $this->belongsTo(LeaveType::class,'leave_type_id');
    }

    public function employeeclass(){
        return $this->belongsTo(EmployeeClass::class,'employee_class_id');
    }
}
