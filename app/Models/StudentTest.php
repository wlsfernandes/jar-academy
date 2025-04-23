<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'test_id', 'answer', 'submitted_at', 'submitted_within_time', 'start_time', 'grade'];


    protected $casts = [
        'start_time' => 'datetime',
        'submitted_at' => 'datetime',
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
}
