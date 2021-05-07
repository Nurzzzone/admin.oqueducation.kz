<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientUser extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * table name
     *
     * @var string
     */
    protected $table = 'client_users';

    /**
     * mass assignable attributes
     *
     * @var array
     */
    protected $fillable = [
        'phone_number',
        'password',
        'user_type'
    ];
    public function type()
    {
        return $this->hasOne(ClientUserType::class, 'id', 'user_type');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'credentials_id', 'id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'credentials_id', 'id');
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
