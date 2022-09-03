<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = ['web'];

    public function jobDescriptions(){
        return $this->belongsToMany(JobDescription::class,'job_skills')->withTimestamps();
    }

    public function candidates(){
        $this->belongsToMany(Candidate::class,'candidate_skills')->withPivot('level')->withTimestamps();
    }
}
