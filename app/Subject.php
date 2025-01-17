<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        
        'teacher_id',
        'module_id' ,
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function module()
    {
        return $this->belongsTo(module::class);
    }
}
