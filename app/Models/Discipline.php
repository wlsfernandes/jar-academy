<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{

    protected $fillable = ['title', 'small_description', 'description', 'module_id', 'institution_id', 'amount', 'currency'];



    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);

    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    // Define the relationship for one or many classrooms

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'discipline_student');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    use HasFactory;
}
