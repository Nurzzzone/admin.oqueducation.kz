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
    protected $fillable = [
        'name', 
        'surname', 
        'middle_name',
        'email_address',
        'phone_number',
        'birth_date',
        'image',
        'description',
        'position',
        'lesson_id'
    ];

    public function classes()
    {
      return $this->hasMany(Classes::class, 'lesson_id', 'lesson_id');
    }
}
