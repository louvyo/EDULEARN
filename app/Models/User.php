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
        'avatar_path',
        'provider',
        'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    // Kelas sebagai guru (owner)
    public function kelasAsGuru()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas')
                    ->where('user_kelas.role', 'guru')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    // Kelas sebagai siswa (approved only)
    public function kelasAsSiswa()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas')
                    ->where('user_kelas.role', 'siswa')
                    ->where('user_kelas.status', 'approved')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    // Pending enrollments (untuk siswa)
    public function pendingEnrollments()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas')
                    ->where('user_kelas.role', 'siswa')
                    ->where('user_kelas.status', 'pending')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->orderBy('created_at', 'desc');
    }

    public function unreadNotifications()
    {
        return $this->hasMany(Notification::class)->where('is_read', false)->orderBy('created_at', 'desc');
    }
}