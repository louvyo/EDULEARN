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
        $user = User::firstWhere('email', 'test@example.com');

        $kelasData = [
            [
                'nama' => 'Matematika Dasar',
                'deskripsi' => 'Kelas pengantar aljabar dan aritmetika',
                'guru' => 'Pak Budi',
                'warna' => 'blue',
                'semester' => 'Semester 1 - 2025',
                'pertemuan_total' => 12,
                'tugas_total' => 4,
                'progress' => 75,
            ],
            [
                'nama' => 'Bahasa Inggris',
                'deskripsi' => 'Kelas komunikasi dan menulis dalam bahasa Inggris',
                'guru' => 'Mrs. Sarah',
                'warna' => 'green',
                'semester' => 'Semester 1 - 2025',
                'pertemuan_total' => 10,
                'tugas_total' => 6,
                'progress' => 45,
            ],
            [
                'nama' => 'Fisika Dasar',
                'deskripsi' => 'Konsep dasar mekanika dan termodinamika',
                'guru' => 'Pak Andi',
                'warna' => 'purple',
                'semester' => 'Semester 1 - 2025',
                'pertemuan_total' => 14,
                'tugas_total' => 5,
                'progress' => 60,
            ],
        ];

        $created = [];
        foreach ($kelasData as $k) {
            $created[] = Kelas::firstOrCreate(['nama' => $k['nama']], $k);
        }

        if ($user) {
            $user->kelas()->syncWithoutDetaching(collect($created)->pluck('id')->toArray());
        }
    }
}
