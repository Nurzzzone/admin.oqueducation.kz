<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTask extends Model
{
    use HasFactory;

    protected $table = "classes_tasks";

    protected $fillable = [
        'name',
        'image',
        'hint',
        'hometask_id',
    ];

    public function hometask()
    {
        return $this->belongsTo(ClassTask::class, 'hometask_id');
    }
}
