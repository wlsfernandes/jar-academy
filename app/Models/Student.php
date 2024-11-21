<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = ['user_id', 'institution_id'];


    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'student_class');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
