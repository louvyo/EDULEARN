<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AktivitasSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::firstWhere('email', 'test@example.com');
        if (! $user) {
            return;
        }

        $kelas = Kelas::take(3)->get();
        if ($kelas->isEmpty()) {
            return;
        }

        Aktivitas::firstOrCreate([
            'user_id' => $user->id,
            'jenis' => 'material',
            'judul' => 'Pengenalan Materi - Matematika',
        ], [
            'deskripsi' => 'Silakan pelajari pengenalan aljabar sebelum pertemuan pertama.',
            'kelas_id' => $kelas[0]->id,
            'waktu' => now()->subDay(),
        ]);

        Aktivitas::firstOrCreate([
            'user_id' => $user->id,
            'jenis' => 'submission',
            'judul' => 'Pengumpulan Tugas 1 - Bahasa Inggris',
        ], [
            'deskripsi' => 'User mengumpulkan tugas essay.',
            'kelas_id' => $kelas[1]->id,
            'waktu' => now()->subHours(5),
        ]);

        Aktivitas::firstOrCreate([
            'user_id' => $user->id,
            'jenis' => 'announcement',
            'judul' => 'Pengumuman - Fisika',
        ], [
            'deskripsi' => 'Kebijakan praktikum minggu depan.',
            'kelas_id' => $kelas[2]->id,
            'waktu' => now()->subMinutes(90),
        ]);
    }
}
