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
        // Gather statistics from the database.
        $totalKelas = Kelas::count();
        $totalTugas = Tugas::count();

        $user = Auth::user();

        if ($user) {
            $pengumpulanSaya = Tugas::where('user_id', $user->id)
                ->where('status', 'selesai')
                ->count();

            $nilaiRata = Tugas::where('user_id', $user->id)
                ->whereNotNull('nilai')
                ->avg('nilai');

            $kelasSaya = $user->kelas()->get();
        } else {
            // Fallbacks when no authenticated user: zero or empty collections.
            $pengumpulanSaya = 0;
            $nilaiRata = null;
            $kelasSaya = Kelas::limit(6)->get();
        }

        // Prepare stats structure for the view (matching previous keys used in blade)
        $stats = [
            ['label' => 'Total Kelas', 'value' => $totalKelas, 'color' => 'blue', 'trend' => ''],
            ['label' => 'Total Tugas', 'value' => $totalTugas, 'color' => 'green', 'trend' => ''],
            ['label' => 'Pengumpulan Saya', 'value' => $pengumpulanSaya, 'color' => 'purple', 'trend' => ''],
            ['label' => 'Nilai Rata-rata', 'value' => $nilaiRata !== null ? number_format($nilaiRata, 2) : '-', 'color' => 'orange', 'trend' => '']
        ];

        // Map kelas to the shape expected by the view
        $classes = $kelasSaya->map(function ($k) {
            return [
                'id' => $k->id,
                'title' => $k->nama,
                'color' => $k->warna ?? 'blue',
                'progress' => (int) $k->progress,
            ];
        });

        return view('dashboard', [
            'stats' => $stats,
            'classes' => $classes,
        ]);
    }
}
