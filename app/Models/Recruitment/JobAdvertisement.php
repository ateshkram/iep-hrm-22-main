<?php

namespace App\Models\Recruitment;

use App\Models\Organisation\Department;
use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAdvertisement extends Model
{
    use HasFactory;

    protected $guarded = ['web','api'];

    protected $dates = ['closing_date','opening_date'];

    public function jobDescription(){
        return $this->belongsTo(JobDescription::class);
    }

    public function checklists(){
        return $this->belongsToMany(Checklist::class,'job_advertisement_checklists')->withTimestamps();
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }


    public function reviewer(){
        return $this->belongsTo(Staff::class);
    }

    public function jobApplications(){
        return $this->hasMany(JobApplication::class);
    }
}
