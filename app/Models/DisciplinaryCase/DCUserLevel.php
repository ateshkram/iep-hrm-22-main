<?php

namespace App\Models\DisciplinaryCase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DisciplinaryCase\DCLevel;
use App\Models\DisciplinaryCase\DisciplinaryCase;

use App\Models\Users\Staff;

class DCUserLevel extends Model
{
    use HasFactory;

    protected $table = 'd_c_user_level';

    public function disciplinary_case_level()
    {
        return $this->belongsTo(DCLevel::class, 'disciplinary_case_level_id');
    }

}
