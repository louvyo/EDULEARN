<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'class',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'user_id');
    }
}