<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Notification;

class TestNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sample users
        $guru = User::where('role', 'guru')->first();
        $siswa = User::where('role', 'siswa')->first();
        
        if (!$guru || !$siswa) {
            $this->command->info('Tidak ada user guru atau siswa untuk testing notifikasi');
            return;
        }
        
        $kelas = Kelas::first();
        
        if (!$kelas) {
            $this->command->info('Tidak ada kelas untuk testing notifikasi');
            return;
        }
        
        // Notifikasi untuk Guru (dari siswa join kelas)
        Notification::create([
            'user_id' => $guru->id,
            'type' => 'enrollment',
            'title' => 'Permintaan Join Kelas',
            'message' => $siswa->name . ' ingin bergabung ke kelas ' . $kelas->nama,
            'link' => route('kelas.students', $kelas->id),
            'is_read' => false,
        ]);
        
        // Notifikasi untuk Siswa (enrollment approved)
        Notification::create([
            'user_id' => $siswa->id,
            'type' => 'enrollment',
            'title' => 'Join Kelas Disetujui',
            'message' => 'Anda telah diterima di kelas ' . $kelas->nama,
            'link' => route('kelas.detail', $kelas->id),
            'is_read' => false,
        ]);
        
        // Notifikasi untuk Siswa (tugas baru)
        Notification::create([
            'user_id' => $siswa->id,
            'type' => 'tugas_baru',
            'title' => 'Tugas Baru: Latihan Soal Bab 1',
            'message' => 'Guru ' . $guru->name . ' membuat tugas baru di kelas ' . $kelas->nama,
            'link' => route('tugas'),
            'is_read' => false,
        ]);
        
        // Notifikasi untuk Siswa (tugas dinilai)
        Notification::create([
            'user_id' => $siswa->id,
            'type' => 'nilai_keluar',
            'title' => 'Tugas Dinilai',
            'message' => 'Tugas "Latihan Soal Bab 1" telah dinilai. Nilai Anda: 85',
            'link' => route('tugas'),
            'is_read' => false,
        ]);
        
        // Notifikasi yang sudah dibaca (untuk testing)
        Notification::create([
            'user_id' => $siswa->id,
            'type' => 'enrollment',
            'title' => 'Notifikasi Lama',
            'message' => 'Ini adalah notifikasi yang sudah dibaca',
            'link' => route('dashboard'),
            'is_read' => true,
            'read_at' => now()->subDays(1),
        ]);
        
        $this->command->info('✅ Sample notifikasi berhasil dibuat!');
        $this->command->info('Notifikasi untuk Guru: ' . $guru->name . ' (' . $guru->email . ')');
        $this->command->info('Notifikasi untuk Siswa: ' . $siswa->name . ' (' . $siswa->email . ')');
    }
}
