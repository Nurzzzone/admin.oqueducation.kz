<?php

namespace App\Models;

use App\Models\StudentParent;
use App\Models\StudentType;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'students';

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

    public function parent()
    {
      return $this->belongsTo(StudentParent::class, 'id');
    }

    public function type()
    {
      return $this->hasOne(StudentType::class, 'id', 'type_id');
    }
}
