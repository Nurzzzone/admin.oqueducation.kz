<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuestion extends Model
{
    use HasFactory;

    protected $table = "classes_questions";

    protected $fillable = [
        'name',
        'image',
        'class_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function answers()
    {
        return $this->hasMany(ClassQuestionAnswer::class, 'question_id');
    }
}
