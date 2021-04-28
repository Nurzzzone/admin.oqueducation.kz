<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJobHistory extends Model
{
    use HasFactory;

    protected $table = 'teachers_jhistory';

    protected $fillable = [
        'position',
        'workplace',
        'start_date',
        'end_date',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
