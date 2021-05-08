<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'students_parents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'p1_full_name',
        'p1_phone_number',
        'p2_full_name',
        'p2_phone_number',
        'student_id'
    ];

    /**
     * Get the student that owns the parent.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
