<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateWorkExperience extends Model
{
    use HasFactory;

    protected $guarded = ['web'];

    public function candidate(){
        $this->belongsTo(Candidate::class);
    }
}
