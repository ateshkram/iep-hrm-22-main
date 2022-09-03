<?php

namespace App\Models\RequestService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RequestService\RSRequest;
use App\Models\RequestService\RSCategories;
use App\Models\User;

class RSCategoryTechnicians extends Model
{
    use HasFactory;

    public function requests(){
        return $this->belongsToMany(RSRequest::class,'category_id');
    }

    public function category(){
        return $this->belongsToMany(RSCategories::class,'category_id');
    }

     public function technician(){
        return $this->belongsToMany(User::class,'user_id');
    }


}
