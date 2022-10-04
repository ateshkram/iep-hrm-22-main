<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationQualification extends Model
{
    use HasFactory;
    protected $guarded = ['web'];
    protected $dates = ['start_date','end_date'];

    public function jobApplication(){
        $this->belongsTo(JobApplication::class);
    }
}
