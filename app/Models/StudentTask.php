<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTask extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'task_id', 'url', 'answer', 'created_at', 'update_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }


    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
