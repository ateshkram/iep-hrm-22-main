<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function leaveapplication(){
        return $this->hasMany(LeaveApplication::class);
    }

    public function leaveentitlement(){
        return $this->hasMany(LeaveEntitlement::class);
    }
}
