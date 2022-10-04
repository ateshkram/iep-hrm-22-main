<?php

namespace App\Models\DisciplinaryCase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DisciplinaryCase\DisciplinaryCase;
use App\Models\Users\Staff;

class DCActivityLogs extends Model
{
    use HasFactory;

    protected $table = "d_c_activity_logs";

    public function case(){
        return $this->belongsTo(DisciplinaryCase::class, 'case_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'user_id');
    }

}
