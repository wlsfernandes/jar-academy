<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = ['title', 'small_description', 'description', 'module_id', 'institution_id', 'amount', 'currency'];



    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);

    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Define the relationship for one or many classrooms
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    use HasFactory;
}
