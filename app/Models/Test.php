<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['discipline_id', 'title', 'description', 'instructions', 'url']; // add as needed

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function submissions()
    {
        return $this->hasMany(StudentTest::class);
    }

}
