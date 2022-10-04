<?php

namespace App\Models\RequestService;

use App\Models\Users\Staff;
use App\Models\RequestService\RSCategories;
use App\Models\RequestService\RSStatus;
use App\Models\RequestService\RSClosureCode;
use App\Models\RequestService\RSPriority;
use App\Models\RequestService\RSCategoryTechnicians;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSRequest extends Model
{
    use HasFactory;

    public function status(){
        return $this->belongsTo(RSStatus::class,'request_status_id');
    }

    public function category(){
        return $this->belongsTo(RSCategories::class,'category_id');
    }

    public function technician(){
        return $this->belongsTo(RSCategoryTechnicians::class,'category_id');
    }

    public function priority(){
        return $this->belongsTo(RSPriority::class,'priority_id');
    }

    public function closure(){
        return $this->belongsTo(RSClosureCode::class,'closure_code_id');
    }

    public function requester(){
        return $this->belongsTo(Staff::class,'requester_id');
    }
}
