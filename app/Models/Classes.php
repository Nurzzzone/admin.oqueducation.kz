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
    
    public function type()
    {
      return $this->hasOne(ClassType::class, 'type_id', 'type_id');
    }

    public function questions()
    {
      return $this->hasMany(ClassQuestion::class);
    }

    public function hometasks()
    {
      return $this->hasMany(ClassHomeTask::class);
    }
}
