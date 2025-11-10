<?php

namespace Database\Seeders;

use App\Models\Tugas;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Submission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TugasSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $guru = User::firstWhere('email', 'guru@edulearn.com');
        $murid = User::firstWhere('email', 'murid@edulearn.com');
        
        if (!$guru) {
            return;
        }

        $kelas = Kelas::all();
        
        // Matematika Dasar
        $matematika = $kelas->firstWhere('nama', 'Matematika Dasar');
        if ($matematika) {
            $tugasMatematika = [
                [
                    'judul' => 'Latihan Aljabar Dasar',
                    'deskripsi' => 'Kerjakan soal-soal aljabar pada buku paket halaman 15-20. Fokus pada pemfaktoran dan persamaan linear.',
                    'deadline' => now()->addDays(3),
                    'prioritas' => 'tinggi',
                    'status' => 'belum_dikerjakan',
                ],
                [
                    'judul' => 'Quiz Aritmetika',
                    'deskripsi' => 'Quiz online tentang operasi bilangan bulat, pecahan, dan desimal. Durasi 30 menit.',
                    'deadline' => now()->addDays(5),
                    'prioritas' => 'sedang',
                    'status' => 'belum_dikerjakan',
                ],
                [
                    'judul' => 'Project Geometri',
                    'deskripsi' => 'Buat maket bangun ruang (kubus, balok, prisma) dengan ukuran minimal 10x10 cm. Sertakan perhitungan volume dan luas permukaan.',
                    'deadline' => now()->addDays(14),
                    'prioritas' => 'sedang',
                    'status' => 'belum_dikerjakan',
                ],
            ];

            foreach ($tugasMatematika as $tugas) {
                Tugas::firstOrCreate([
                    'judul' => $tugas['judul'],
                    'kelas_id' => $matematika->id,
                ], array_merge($tugas, ['user_id' => $guru->id]));
            }
        }

        // Bahasa Inggris
        $inggris = $kelas->firstWhere('nama', 'Bahasa Inggris');
        if ($inggris) {
            $tugasInggris = [
                [
                    'judul' => 'Essay Writing Task',
                    'deskripsi' => 'Write an essay about "My Future Dreams" (minimum 300 words). Include introduction, body paragraphs, and conclusion.',
                    'deadline' => now()->addDays(7),
                    'prioritas' => 'tinggi',
                    'status' => 'belum_dikerjakan',
                ],
                [
                    'judul' => 'Grammar Exercise',
                    'deskripsi' => 'Complete the grammar workbook pages 25-30. Focus on Present Perfect and Past Simple tenses.',
                    'deadline' => now()->addDays(4),
                    'prioritas' => 'sedang',
                    'status' => 'belum_dikerjakan',
                ],
                [
                    'judul' => 'Reading Comprehension',
                    'deskripsi' => 'Read the short story "The Gift" and answer all comprehension questions. Prepare for class discussion.',
                    'deadline' => now()->addDays(2),
                    'prioritas' => 'tinggi',
                    'status' => 'belum_dikerjakan',
                ],
            ];

            foreach ($tugasInggris as $tugas) {
                Tugas::firstOrCreate([
                    'judul' => $tugas['judul'],
                    'kelas_id' => $inggris->id,
                ], array_merge($tugas, ['user_id' => $guru->id]));
            }
        }

        // Fisika
        $fisika = $kelas->firstWhere('nama', 'Fisika');
        if ($fisika) {
            $tugasFisika = [
                [
                    'judul' => 'Praktikum Gerak Lurus',
                    'deskripsi' => 'Lakukan percobaan gerak lurus beraturan menggunakan mobil mainan. Buat laporan lengkap dengan data pengamatan, grafik, dan analisis.',
                    'deadline' => now()->addDays(10),
                    'prioritas' => 'tinggi',
                    'status' => 'belum_dikerjakan',
                ],
                [
                    'judul' => 'Soal Hukum Newton',
                    'deskripsi' => 'Kerjakan 10 soal tentang Hukum Newton I, II, dan III pada buku paket halaman 45-48.',
                    'deadline' => now()->addDays(6),
                    'prioritas' => 'sedang',
                    'status' => 'belum_dikerjakan',
                ],
            ];

            foreach ($tugasFisika as $tugas) {
                Tugas::firstOrCreate([
                    'judul' => $tugas['judul'],
                    'kelas_id' => $fisika->id,
                ], array_merge($tugas, ['user_id' => $guru->id]));
            }
        }

        // Buat beberapa submission untuk testing
        if ($murid) {
            $allTugas = Tugas::all();
            
            // Submit beberapa tugas dengan nilai
            if ($allTugas->count() > 0) {
                // Submission 1 - sudah dinilai
                $tugas1 = $allTugas->first();
                Submission::firstOrCreate([
                    'tugas_id' => $tugas1->id,
                    'user_id' => $murid->id,
                ], [
                    'content' => 'Saya sudah menyelesaikan semua soal dengan baik.',
                    'submitted_at' => now()->subDays(2),
                    'status' => 'on_time',
                    'grade' => 85,
                    'feedback' => 'Pekerjaan bagus! Perhitungan sudah benar. Tingkatkan ketelitian.',
                ]);

                // Submission 2 - sudah submit tapi belum dinilai
                if ($allTugas->count() > 1) {
                    $tugas2 = $allTugas->get(1);
                    Submission::firstOrCreate([
                        'tugas_id' => $tugas2->id,
                        'user_id' => $murid->id,
                    ], [
                        'content' => 'Essay tentang cita-cita saya terlampir.',
                        'submitted_at' => now()->subHours(5),
                        'status' => 'on_time',
                    ]);
                }
            }
        }
    }
}
