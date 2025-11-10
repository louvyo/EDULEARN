<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Tugas baru
            Notification::create([
                'user_id' => $user->id,
                'type' => 'tugas_baru',
                'title' => 'Tugas Baru: Laporan Praktikum Kimia',
                'message' => 'Pak Budi telah menambahkan tugas baru "Laporan Praktikum Kimia". Deadline: 15 November 2025',
                'link' => route('tugas.show', ['id' => 1]),
                'is_read' => false,
                'created_at' => now()->subHours(2),
            ]);

            // Deadline reminder
            Notification::create([
                'user_id' => $user->id,
                'type' => 'deadline_reminder',
                'title' => 'Pengingat: Tugas Segera Berakhir!',
                'message' => 'Tugas "Essay Bahasa Indonesia" akan berakhir dalam 2 hari. Jangan lupa untuk submit!',
                'link' => route('tugas.show', ['id' => 2]),
                'is_read' => false,
                'created_at' => now()->subHours(5),
            ]);

            // Nilai keluar
            Notification::create([
                'user_id' => $user->id,
                'type' => 'nilai_keluar',
                'title' => 'Nilai Keluar: Tugas Matematika',
                'message' => 'Nilai untuk tugas "Soal Trigonometri" sudah keluar. Klik untuk melihat nilai Anda.',
                'link' => route('nilai'),
                'is_read' => true,
                'read_at' => now()->subHours(1),
                'created_at' => now()->subDay(),
            ]);

            // Info umum
            Notification::create([
                'user_id' => $user->id,
                'type' => 'info',
                'title' => 'Pengumuman: Libur Semester',
                'message' => 'Libur semester akan dimulai tanggal 20 Desember 2025. Pastikan semua tugas sudah dikumpulkan.',
                'link' => null,
                'is_read' => true,
                'read_at' => now()->subHours(3),
                'created_at' => now()->subDays(2),
            ]);

            // Deadline reminder 2
            Notification::create([
                'user_id' => $user->id,
                'type' => 'deadline_reminder',
                'title' => 'Deadline H-1: Presentasi Fisika',
                'message' => 'Besok adalah deadline untuk tugas "Presentasi Hukum Newton". Pastikan sudah siap!',
                'link' => route('tugas.show', ['id' => 3]),
                'is_read' => false,
                'created_at' => now()->subMinutes(30),
            ]);
        }
    }
}
