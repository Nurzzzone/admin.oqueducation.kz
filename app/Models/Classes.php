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

    protected $fillable = [
      'title',
      'source_ulr',
      'type_id',
    ];
    
    public function type()
    {
      return $this->hasOne(ClassType::class, 'id', 'type_id');
    }

    public function questions()
    {
      return $this->hasMany(ClassQuestion::class, 'class_id', 'class_id');
    }

    public function hometasks()
    {
      return $this->hasMany(ClassHomeTask::class, 'class_id', 'class_id');
    }
}
