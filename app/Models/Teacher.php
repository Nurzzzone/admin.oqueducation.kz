<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable implements JWTSubject
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    protected $guard = 'teacher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'name', 
        'surname', 
        'middle_name',
        'home_address',
        'email_address',
        'phone_number',
        'birth_date',
        'image',
        'description',
        'position',
        'password',
        'is_active'
    ];

    protected $with = [
        'jobHistory',
        'socials'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function jobHistory()
    {
        return $this->hasMany(TeacherJobHistory::class, 'teacher_id');
    }

    public function socials()
    {
        return $this->hasOne(TeacherSocialLink::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
