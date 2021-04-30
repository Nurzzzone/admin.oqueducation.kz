<?php

namespace App\Models;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];
    
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
