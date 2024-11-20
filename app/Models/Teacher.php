<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['user_id', 'institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
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
        return $this->hasManyThrough(Assignment::class, Classroom::class);
    }

    use HasFactory;
}
