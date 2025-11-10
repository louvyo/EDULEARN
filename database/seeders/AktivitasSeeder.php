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
        $users = User::all();
        if ($users->isEmpty()) {
            return;
        }

        $kelas = Kelas::all();
        if ($kelas->isEmpty()) {
            return;
        }
        
        $guru = User::firstWhere('email', 'guru@edulearn.com');
        $murid = User::firstWhere('email', 'murid@edulearn.com');

        $aktivitasData = [
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'material',
                'judul' => 'Materi Baru: Persamaan Kuadrat',
                'deskripsi' => 'Pak Budi mengunggah materi tentang persamaan kuadrat dan cara penyelesaiannya',
                'kelas_id' => $kelas->where('nama', 'Matematika Dasar')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subMinutes(15),
            ],
            [
                'user_id' => $murid?->id ?? $users->first()->id,
                'jenis' => 'submission',
                'judul' => 'Murid Mengumpulkan Essay Writing Task',
                'deskripsi' => 'Murid mengumpulkan tugas essay "My Future Dreams" tepat waktu',
                'kelas_id' => $kelas->where('nama', 'Bahasa Inggris')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subMinutes(45),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'announcement',
                'judul' => 'Pengumuman: Praktikum Gerak Lurus',
                'deskripsi' => 'Praktikum Gerak Lurus akan dilaksanakan di Lab Fisika minggu depan, jangan lupa bawa jas lab',
                'kelas_id' => $kelas->where('nama', 'Fisika')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHour(),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'grade',
                'judul' => 'Nilai Keluar: Latihan Aljabar Dasar',
                'deskripsi' => 'Pak Budi sudah menilai tugas Latihan Aljabar Dasar. Rata-rata kelas: 85',
                'kelas_id' => $kelas->where('nama', 'Matematika Dasar')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(2),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'material',
                'judul' => 'Materi: Hukum Newton III',
                'deskripsi' => 'Pak Andi mengunggah slide presentasi tentang Hukum Newton III dan aplikasinya',
                'kelas_id' => $kelas->where('nama', 'Fisika')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(3),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'announcement',
                'judul' => 'Reminder: Deadline Reading Comprehension',
                'deskripsi' => 'Jangan lupa kumpulkan tugas Reading Comprehension besok! Persiapkan juga untuk diskusi kelas',
                'kelas_id' => $kelas->where('nama', 'Bahasa Inggris')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(5),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'material',
                'judul' => 'Video: Pemfaktoran Aljabar',
                'deskripsi' => 'Pak Budi membagikan video tutorial tentang cara pemfaktoran persamaan aljabar',
                'kelas_id' => $kelas->where('nama', 'Matematika Dasar')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(8),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'announcement',
                'judul' => 'Info: Quiz Aritmetika Minggu Depan',
                'deskripsi' => 'Quiz Aritmetika akan dilaksanakan minggu depan secara online. Pastikan koneksi internet stabil',
                'kelas_id' => $kelas->where('nama', 'Matematika Dasar')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(10),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'material',
                'judul' => 'Materi: Grammar - Tenses',
                'deskripsi' => 'Mrs. Sarah mengunggah materi lengkap tentang Present Perfect dan Past Simple tenses',
                'kelas_id' => $kelas->where('nama', 'Bahasa Inggris')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(12),
            ],
            [
                'user_id' => $guru?->id ?? $users->first()->id,
                'jenis' => 'announcement',
                'judul' => 'Pengumuman: Project Geometri',
                'deskripsi' => 'Project Geometri dikumpulkan 2 minggu dari sekarang. Boleh dikerjakan berkelompok (max 3 orang)',
                'kelas_id' => $kelas->where('nama', 'Matematika Dasar')->first()?->id ?? $kelas->first()->id,
                'waktu' => now()->subHours(15),
            ],
        ];

        foreach ($aktivitasData as $data) {
            if ($data['kelas_id']) {
                Aktivitas::firstOrCreate(
                    [
                        'judul' => $data['judul'],
                        'kelas_id' => $data['kelas_id'],
                    ],
                    $data
                );
            }
        }
    }
}
