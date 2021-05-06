<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientUserType extends Model
{
    use HasFactory;

    /**
     * table name
     *
     * @var string
     */
    protected $table = 'client_users_types';

    /**
     * mass assignable attributes
     * 
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    
    public function user()
    {
        return $this->belongsTo(ClientUser::class, 'user_type', 'id');
    }
}
