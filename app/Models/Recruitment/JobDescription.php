<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model
{
    use HasFactory;
    protected $guarded = ['web'];
    public function skills(){
        return $this->belongsToMany(Skill::class,'job_skills')->withTimestamps();
    }

    public function jobAdvertisements(){
        return $this->hasMany(JobAdvertisement::class);
    }
}
