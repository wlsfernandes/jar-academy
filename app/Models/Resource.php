<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'description', 'resource_type', 'type', 'url', 'created_at', 'updated_at'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
