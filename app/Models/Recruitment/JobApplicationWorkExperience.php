<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationWorkExperience extends Model
{
    use HasFactory;
    protected $guarded = ['web'];
    protected $dates = ['date_joined','date_left'];

    public function jobApplication(){
        $this->belongsTo(JobApplication::class);
    }
}
