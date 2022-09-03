<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $guarded = ['web','api'];

    public function jobAdvertisements(){
        return $this->belongsToMany(JobAdvertisement::class,'job_advertisement_checklists')->withTimestamps();
    }
}
