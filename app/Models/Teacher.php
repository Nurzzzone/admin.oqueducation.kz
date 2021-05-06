<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
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
        'birth_date',
        'image',
        'description',
        'position',
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
}
