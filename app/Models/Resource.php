<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline_id',
        'title',
        'description',
        'resource_type',
        'type',
        'url',
        'created_at',
        'updated_at'
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot(['views', 'last_viewed_at'])
            ->withTimestamps();
    }

    public static function getResourceTypes()
    {
        return ['documento'];
    }

    public static function getTypes()
    {
        return ['audio', 'docx', 'pdf', 'power-point', 'video'];
    }
}
