<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['name', 'course_id', 'teacher_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_class');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
