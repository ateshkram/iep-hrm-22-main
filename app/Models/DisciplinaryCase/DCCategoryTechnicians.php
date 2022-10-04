<?php

namespace App\Models\DisciplinaryCase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DisciplinaryCase\DCCommittee;

class DCCategoryTechnicians extends Model
{
    use HasFactory;

    public function committee(){
        return $this->belongsTo(DCCommittee::class, 'committee_id');
    }
}
