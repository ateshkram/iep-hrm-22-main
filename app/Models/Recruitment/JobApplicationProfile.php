<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationProfile extends Model
{
    use HasFactory;

    protected $guarded = ['web'];

    public function jobApplication(){
        $this->belongsTo(JobApplication::class);
    }
}
