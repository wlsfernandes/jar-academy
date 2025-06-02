<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'title',
        'description',
        'type',
        'url',
    ];

    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class);
    }
    public function studentTaskFor($userId)
    {
        return $this->studentTasks->firstWhere('student_id', $userId);
    }
}