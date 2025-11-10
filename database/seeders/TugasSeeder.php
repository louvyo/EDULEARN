<?php

namespace Database\Seeders;

use App\Models\Tugas;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::firstWhere('email', 'test@example.com');
        if (! $user) {
            return;
        }

        $kelas = Kelas::all();
        foreach ($kelas as $k) {
            Tugas::firstOrCreate([
                'judul' => 'Tugas 1: ' . $k->nama,
                'kelas_id' => $k->id,
                'user_id' => $user->id,
            ], [
                'deskripsi' => 'Kerjakan soal pada bab pertama.',
                'deadline' => now()->addDays(7),
                'prioritas' => 'sedang',
                'status' => 'belum_dikerjakan',
            ]);
        }
    }
}
