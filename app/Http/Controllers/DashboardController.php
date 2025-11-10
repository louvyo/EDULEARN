<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Aktivitas;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';

        if ($isGuru) {
            // Dashboard untuk Guru
            return $this->dashboardGuru();
        } else {
            // Dashboard untuk Siswa
            return $this->dashboardSiswa();
        }
    }

    /**
     * Dashboard untuk Guru
     */
    private function dashboardGuru()
    {
        $totalKelas = Kelas::count();
        $totalTugas = Tugas::count();
        $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
        
        // Tugas yang perlu dinilai (tugas yang sudah dikumpulkan tapi belum dinilai)
        $tugasPerluDinilai = \App\Models\Submission::whereNull('grade')->count();

        $stats = [
            ['label' => 'Total Kelas', 'value' => $totalKelas, 'color' => 'blue', 'icon' => 'book', 'trend' => ''],
            ['label' => 'Total Tugas', 'value' => $totalTugas, 'color' => 'green', 'icon' => 'clipboard', 'trend' => ''],
            ['label' => 'Total Siswa', 'value' => $totalSiswa, 'color' => 'purple', 'icon' => 'users', 'trend' => ''],
            ['label' => 'Perlu Dinilai', 'value' => $tugasPerluDinilai, 'color' => 'orange', 'icon' => 'alert', 'trend' => '']
        ];

        // Kelas yang diampu guru
        $kelasSaya = Kelas::orderBy('created_at', 'desc')->limit(6)->get();

        // Tugas terbaru yang dibuat
        $tugasTerbaru = Tugas::with('kelas')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $classes = $kelasSaya->map(function ($k) {
            $totalSiswa = $k->users()->where('user_kelas.role', 'siswa')->count();
            $totalTugas = $k->tugas()->count();
            
            return [
                'id' => $k->id,
                'title' => $k->nama,
                'color' => $k->warna ?? 'blue',
                'total_siswa' => $totalSiswa,
                'total_tugas' => $totalTugas,
            ];
        });

        return view('dashboard-guru', [
            'stats' => $stats,
            'classes' => $classes,
            'tugasTerbaru' => $tugasTerbaru,
        ]);
    }

    /**
     * Dashboard untuk Siswa
     */
    private function dashboardSiswa()
    {
        $user = Auth::user();
        
        // Kelas yang diikuti siswa (status approved)
        $kelasSaya = $user->kelasAsSiswa()->orderBy('kelas.created_at', 'desc')->limit(6)->get();
        
        $totalKelas = $kelasSaya->count();
        
        // Tugas dari kelas yang diikuti
        $kelasIds = $kelasSaya->pluck('id');
        $totalTugas = Tugas::whereIn('kelas_id', $kelasIds)->count();

        // Pengumpulan tugas siswa
        $pengumpulanSaya = \App\Models\Submission::where('user_id', $user->id)->count();
        
        // Nilai rata-rata siswa
        $nilaiRata = \App\Models\Submission::where('user_id', $user->id)
            ->whereNotNull('grade')
            ->avg('grade');

        $stats = [
            ['label' => 'Total Kelas', 'value' => $totalKelas, 'color' => 'blue', 'icon' => 'book', 'trend' => ''],
            ['label' => 'Total Tugas', 'value' => $totalTugas, 'color' => 'green', 'icon' => 'clipboard', 'trend' => ''],
            ['label' => 'Pengumpulan Saya', 'value' => $pengumpulanSaya, 'color' => 'purple', 'icon' => 'check', 'trend' => ''],
            ['label' => 'Nilai Rata-rata', 'value' => $nilaiRata !== null ? number_format($nilaiRata, 2) : '-', 'color' => 'orange', 'icon' => 'star', 'trend' => '']
        ];

        // Map kelas to the shape expected by the view
        $classes = $kelasSaya->map(function ($k) use ($user) {
            // Hitung progress berdasarkan tugas yang sudah dikumpulkan
            $totalTugas = $k->tugas()->count();
            $tugasSelesai = \App\Models\Submission::where('user_id', $user->id)
                ->whereIn('tugas_id', $k->tugas()->pluck('id'))
                ->count();
            
            $progress = $totalTugas > 0 ? round(($tugasSelesai / $totalTugas) * 100) : 0;
            
            return [
                'id' => $k->id,
                'title' => $k->nama,
                'color' => $k->warna ?? 'blue',
                'progress' => (int) $progress,
            ];
        });

        return view('dashboard', [
            'stats' => $stats,
            'classes' => $classes,
        ]);
    }
}
