<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $kelas = $user->kelas()->with(['tugas' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])->get();

            // Hitung statistik nilai
            $totalTugas = Tugas::where('user_id', $user->id)->count();
            $tugasSelesai = Tugas::where('user_id', $user->id)
                ->where('status', 'selesai')
                ->count();
            $rataRataNilai = Tugas::where('user_id', $user->id)
                ->where('status', 'selesai')
                ->avg('nilai') ?? 0;
        } else {
            // Public fallback: no personal data
            $kelas = collect();
            $totalTugas = 0;
            $tugasSelesai = 0;
            $rataRataNilai = 0;
        }

        return view('nilai.index', compact('kelas', 'totalTugas', 'tugasSelesai', 'rataRataNilai'));
    }
}
