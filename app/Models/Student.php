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


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'discipline_student');
    }
    use HasFactory;
}
