<?php

namespace App\Models\Users;

use App\Models\Leave\LeaveApplication;
use App\Models\Recruitment\JobAdvertisement;
use App\Models\RequestService\RSCategoryTechnicians;
use App\Models\RequestService\RSRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Staff extends Model implements LdapAuthenticatable,JWTSubject
{
    use HasFactory, Notifiable, AuthenticatesWithLdap, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @inheritdoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritdoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function jobAdvertisements(){
        return $this->hasMany(JobAdvertisement::class,'reviewer_id');
    }

    public function supervisor(){
        return $this->belongsTo(Staff::class,'supervisor_id');
    }

    public function leave_applications(){
        return $this->hasMany(LeaveApplication::class);
    }

    public function requests(){
        return $this->hasMany(RSRequest::class);
    }

    public function category(){
        return $this->hasMany(RSCategoryTechnicians::class);
    }
}
