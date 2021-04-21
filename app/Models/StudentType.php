<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
   protected $table = 'students_types';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
