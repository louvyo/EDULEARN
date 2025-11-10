<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        // Auth removed: no personal grade data available in public view
        $kelas = collect();
        $totalTugas = 0;
        $tugasSelesai = 0;
        $rataRataNilai = 0;

        return view('nilai.index', compact('kelas', 'totalTugas', 'tugasSelesai', 'rataRataNilai'));
    }
}
