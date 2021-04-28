<?php

namespace App\Models;

use App\Models\StudentType;
use App\Models\StudentParent;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'students';

   protected $guard = 'student';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'surname', 
      'middle_name',
      'email_address',
      'home_address',
      'phone_number',
      'birth_date',
      'image',
      'password',
      'type_id',
      'city'
    ];

    protected $with = [
      'parent',
      'type'
    ];

    protected $hidden = [
      'password', 'remember_token'
    ];

    public function parent()
    {
      return $this->belongsTo(StudentParent::class, 'id');
    }

    public function type()
    {
      return $this->hasOne(StudentType::class, 'id', 'type_id');
    }
}
