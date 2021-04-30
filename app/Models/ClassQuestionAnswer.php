<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = "classes_answers";

    protected $fillable = [
        'name',
        'image',
        'question_id',
    ];

    public function question()
    {
        return $this->belongsTo(ClassQuestion::class);
    }
}
