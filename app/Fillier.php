<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fillier extends Model
{
    protected $fillable = [
        'fillier_name',
        'teacher_id',
        'fillier_description'
    ];

   

    

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class);
    }
}
