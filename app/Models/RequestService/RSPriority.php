<?php

namespace App\Models\RequestService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RequestService\RSRequest;

class RSPriority extends Model
{
    use HasFactory;

    public function requests(){
        return $this->hasMany(RSRequest::class);
    }
}
