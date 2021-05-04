<?php

namespace App\Models;

use App\Models\StudentType;
use App\Models\StudentParent;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable implements JWTSubject
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

    public function parent()
    {
      return $this->belongsTo(StudentParent::class, 'id');
    }

    public function type()
    {
      return $this->hasOne(StudentType::class, 'id', 'type_id');
    }
}
