<?php

namespace App\Models\Recruitment;

use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $guarded = ['web','api'];

    public function jobAdvertisement(){
        return $this->belongsTo(JobAdvertisement::class);
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class);
    }

    public function reviewer(){
        return $this->belongsTo(Staff::class);
    }

    public function profile(){
        return $this->hasOne(JobApplicationProfile::class);
    }

    public function attachments(){
        return $this->hasMany(JobApplicationAttachment::class);
    }

    public function qualifications(){
        return $this->hasMany(JobApplicationQualification::class);
    }

    public function workExperiences(){
        return $this->hasMany(JobApplicationWorkExperience::class);
    }
}
