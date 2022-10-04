<?php

namespace App\Models\DisciplinaryCase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users\Staff;

class DCCommitteeTechnicians extends Model
{
    use HasFactory;

    protected $table = 'd_c_committee_technicians';

    public function staff(){
        return $this->belongsTo(Staff::class, 'user_id');
    }

}
