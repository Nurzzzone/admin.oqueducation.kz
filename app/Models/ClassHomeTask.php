<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHomeTask extends Model
{
    use HasFactory;

    protected $table = "classes_hometasks";

    protected $fillable = [
        'name',
        'class_id'
    ];

    protected $with = [
        'tasks',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'hometask_id');
    }

    public function tasks()
    {
        return $this->hasMany(ClassTask::class, 'hometask_id', 'id');
    }
}
