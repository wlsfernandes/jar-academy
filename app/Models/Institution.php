<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
