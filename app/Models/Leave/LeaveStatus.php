<?php

namespace App\Models\Leave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveStatus extends Model
{
    use HasFactory;

    public function leaveapplication(){
        return $this->hasMany(LeaveApplication::class);
    }
}
