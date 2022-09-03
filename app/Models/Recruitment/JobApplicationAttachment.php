<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationAttachment extends Model
{
    use HasFactory;

    public function application(){
        return $this->belongsTo(JobApplication::class);
    }
}
