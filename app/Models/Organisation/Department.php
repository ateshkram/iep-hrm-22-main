<?php

namespace App\Models\Organisation;

use App\Models\Recruitment\JobAdvertisement;
use App\Models\Recruitment\JobDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function jobs(){
        return $this->hasMany(JobAdvertisement::class);
    }
}
