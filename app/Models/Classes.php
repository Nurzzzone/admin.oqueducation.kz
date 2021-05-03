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

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'title',
      'source_url',
      'type_id',
    ];

    protected $with = [
      'type',
      'questions',
      'hometasks'
    ];
    
    public function type()
    {
      return $this->hasOne(ClassType::class, 'id', 'type_id');
    }

    public function questions()
    {
      return $this->hasMany(ClassQuestion::class, 'class_id', 'id');
    }

    public function hometasks()
    {
      return $this->hasOne(ClassHomeTask::class, 'class_id', 'id');
    }
}
