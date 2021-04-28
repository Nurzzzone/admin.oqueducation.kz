<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSocialLink extends Model
{
    use HasFactory;

    protected $table = 'teachers_socials';

    protected $fillable = [
        'facebook_url',
        'instagram_url',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
