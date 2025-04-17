<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'institution_id', 'isFree', 'order'];
    protected $casts = [
        'isFree' => 'boolean',
    ];
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function disciplines()
    {
        return $this->hasMany(Discipline::class)->orderBy('order');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'certification_student');
    }

}
