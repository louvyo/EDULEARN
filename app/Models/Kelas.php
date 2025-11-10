<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'guru',
        'warna',
        'semester',
        'tahun_ajaran',
        'pertemuan_total',
        'tugas_total',
        'progress'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_kelas');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
