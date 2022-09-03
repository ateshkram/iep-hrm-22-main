<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $guarded = ['web'];

    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }

    public function candidateQualifications(){
        return $this->hasMany(CandidateQualification::class);
    }

    public function candidateWorkExperiences(){
        return $this->hasMany(CandidateWorkExperience::class);
    }
}
