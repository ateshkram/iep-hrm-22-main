<?php

namespace App\Models\DisciplinaryCase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DisciplinaryCase\DCCategories;
use App\Models\DisciplinaryCase\DCStatus;
use App\Models\DisciplinaryCase\DCUserLevel;
use App\Models\DisciplinaryCase\DCLevel;
use App\Models\DisciplinaryCase\DCCategoryTechnicians;
use App\Models\Users\Staff;

class DisciplinaryCase extends Model
{
    use HasFactory;

    protected $table = "disciplinary_case";

    public function staff(){
        return $this->belongsTo(Staff::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(DCCategories::class,'category_id');
    }

    public function technician(){
        return $this->belongsTo(DCCategoryTechnicians::class,'category_id');
    }

    public function status(){
        return $this->belongsTo(DCStatus::class, 'case_status_id');
    }

}
