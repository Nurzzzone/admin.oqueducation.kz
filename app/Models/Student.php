<?php

namespace App\Models;

use App\Lesson;
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
      'phone_number',
      'birth_date',
      'image',
      'description',
      'lesson_id'
  ];

  public function classes()
  {
    return $this->hasMany(Classes::class, 'lesson_id', 'lesson_id');
  }
}
