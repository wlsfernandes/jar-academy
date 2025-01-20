<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id'); // Assuming students are stored in the `users` table
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
