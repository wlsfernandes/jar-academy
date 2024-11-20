<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
   
    protected $fillable = ['name', 'description', 'teacher_id', 'institution_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
   
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    use HasFactory;
}
