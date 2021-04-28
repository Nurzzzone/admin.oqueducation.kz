<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';

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

    protected $with = 
    [
        'jobHistory',
        'socials'
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
