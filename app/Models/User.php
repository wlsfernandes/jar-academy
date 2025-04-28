<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'institution_id',
        'is_free'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'email_verified_at' => 'datetime',
    ];
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'teacher_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($role)
    {
        return $this->roles->pluck('name')->contains($role);
    }
}
