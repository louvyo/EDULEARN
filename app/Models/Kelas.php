<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode_kelas',
        'deskripsi',
        'guru',
        'warna',
        'semester',
        'tahun_ajaran',
        'pertemuan_total',
        'tugas_total',
        'progress'
    ];

    // Generate kode kelas unik saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kelas) {
            if (empty($kelas->kode_kelas)) {
                $kelas->kode_kelas = self::generateKodeKelas();
            }
        });
    }

    // Generate kode kelas random 8 karakter (uppercase + angka)
    public static function generateKodeKelas()
    {
        do {
            $kode = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8));
        } while (self::where('kode_kelas', $kode)->exists());

        return $kode;
    }

    // Relationship: All enrolled users (guru + siswa)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_kelas')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    // Relationship: Hanya siswa yang sudah approved
    public function students()
    {
        return $this->belongsToMany(User::class, 'user_kelas')
                    ->where('user_kelas.role', 'siswa')
                    ->where('user_kelas.status', 'approved')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    // Relationship: Pending enrollments untuk approval
    public function pendingEnrollments()
    {
        return $this->belongsToMany(User::class, 'user_kelas')
                    ->where('user_kelas.status', 'pending')
                    ->where('user_kelas.role', 'siswa')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }
}
