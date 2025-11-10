<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the student's classes (paginated) and latest activities.
     */
    public function index(Request $request)
    {
        // Auth removed: always show public listing and no per-user activities
        $classes = Kelas::paginate(9);
        $latestActivities = collect();

        return view('kelas.index', compact('classes', 'latestActivities'));
    }

    /**
     * Show the class detail page for a class the user belongs to.
     */
    public function show($id)
    {
        // Auth removed: show class without enforcing membership (public view)
        $kelas = Kelas::with(['tugas', 'aktivitas'])->findOrFail($id);

        // For public view, show tugas/aktivitas for the class (not user-specific)
        $tugas = Tugas::where('kelas_id', $id)
            ->orderBy('deadline', 'asc')
            ->get();

        $aktivitas = Aktivitas::where('kelas_id', $id)
            ->orderBy('waktu', 'desc')
            ->get();

        return view('kelas.detail', compact('kelas', 'tugas', 'aktivitas'));
    }
}