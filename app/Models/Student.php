<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'institution_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function testSubmissions()
    {
        return $this->hasMany(StudentTest::class);
    }

    public function certifications()
    {
        return $this->belongsToMany(Certification::class, 'certification_student')
            ->withPivot(['is_completed', 'completed_at'])
            ->withTimestamps();
    }

    public function disciplines()
    {
        return $this->belongsToMany(Discipline::class, 'discipline_student')
            ->withPivot(['is_submitted', 'submitted_at', 'is_approved', 'approved_at', 'feedback'])
            ->withTimestamps();
    }
}
