<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'institution_id', 'isFree', 'order', 'parent_id'];
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
        return $this->belongsToMany(Student::class, 'certification_student')
            ->withPivot(['is_completed', 'completed_at'])
            ->withTimestamps();
    }
    public function parent()
    {
        return $this->belongsTo(Certification::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Certification::class, 'parent_id');
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
