<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';
    
    public function student()
    {
      return $this->belongsTo(Student::class, 'student_id');
    }

    public function teacher()
    {
      return $this->belongsTo(Teacher::class, 'lesson_id');
    }

    public function type()
    {
      return $this->hasOne(ClassType::class, 'type_id', 'type_id');
    }
}
