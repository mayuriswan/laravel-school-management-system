<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'speciality',
        'grade',
        'statu',
        'dateofbirth',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function classes()
    {
        return $this->hasMany(Grade::class);
    }

    public function students() 
    {
        return $this->classes()->withCount('students');
    }
}
