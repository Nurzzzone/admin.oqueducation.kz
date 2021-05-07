<?php

namespace App\Models;

use App\Models\StudentType;
use App\Models\StudentParent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
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
      'birth_date',
      'image',
      'type_id',
      'city',
      'credentials_id',
    ];

    protected $with = [
      'parent',
      'type',
      'credentials'
    ];

    protected $hidden = [
      'password', 'remember_token'
    ];
    
    public function parent()
    {
      return $this->belongsTo(StudentParent::class);
    }

    public function type()
    {
      return $this->hasOne(StudentType::class, 'id', 'type_id');
    }

    public function credentials()
    {
      return $this->belongsTo(ClientUser::class, 'credentials_id', 'id');
    }
}
