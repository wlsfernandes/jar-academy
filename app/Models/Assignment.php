<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'class_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


}
