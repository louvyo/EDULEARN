<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $murid = User::firstWhere('email', 'murid@edulearn.com');
        $testUser = User::firstWhere('email', 'test@example.com');

        $kelasData = [
            [
                'nama' => 'Matematika Dasar',
                'deskripsi' => 'Kelas pengantar aljabar, aritmetika, dan geometri dasar untuk siswa kelas X',
                'guru' => 'Pak Budi Santoso, S.Pd',
                'warna' => 'blue',
                'semester' => 'Semester Ganjil 2024/2025',
                'pertemuan_total' => 12,
                'tugas_total' => 8,
                'progress' => 75,
            ],
            [
                'nama' => 'Bahasa Inggris',
                'deskripsi' => 'Kelas komunikasi dan menulis dalam bahasa Inggris, grammar, dan speaking practice',
                'guru' => 'Mrs. Sarah Johnson',
                'warna' => 'green',
                'semester' => 'Semester Ganjil 2024/2025',
                'pertemuan_total' => 10,
                'tugas_total' => 10,
                'progress' => 45,
            ],
            [
                'nama' => 'Fisika',
                'deskripsi' => 'Konsep dasar mekanika, termodinamika, dan optika untuk kelas X',
                'guru' => 'Pak Andi Wijaya, M.Pd',
                'warna' => 'purple',
                'semester' => 'Semester Ganjil 2024/2025',
                'pertemuan_total' => 14,
                'tugas_total' => 6,
                'progress' => 60,
            ],
        ];

        $created = [];
        foreach ($kelasData as $k) {
            $kelas = Kelas::firstOrCreate(['nama' => $k['nama']], $k);
            $created[] = $kelas;
        }

        // Attach kelas to users
        if ($murid) {
            $murid->kelas()->syncWithoutDetaching(collect($created)->pluck('id')->toArray());
        }
        if ($testUser) {
            $testUser->kelas()->syncWithoutDetaching(collect($created)->pluck('id')->toArray());
        }
    }
}
