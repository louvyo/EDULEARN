<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the student's classes (paginated) and latest activities.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $classes = $user->kelas()->paginate(9);

            $latestActivities = Aktivitas::where('user_id', $user->id)
                ->orderBy('waktu', 'desc')
                ->limit(5)
                ->get();
        } else {
            // Public fallback: show all classes and no user-specific activities
            $classes = Kelas::paginate(9);
            $latestActivities = collect();
        }

        return view('kelas.index', compact('classes', 'latestActivities'));
    }

    /**
     * Show the class detail page for a class the user belongs to.
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user) {
            // Ensure the user belongs to this class
            $kelas = $user->kelas()->with(['tugas', 'aktivitas'])->findOrFail($id);

            // Get tugas for this user in this class
            $tugas = Tugas::where('kelas_id', $id)
                ->where('user_id', $user->id)
                ->orderBy('deadline', 'asc')
                ->get();

            $aktivitas = Aktivitas::where('kelas_id', $id)
                ->where('user_id', $user->id)
                ->orderBy('waktu', 'desc')
                ->get();
        } else {
            // Public fallback: show class without enforcing membership
            $kelas = Kelas::with(['tugas', 'aktivitas'])->findOrFail($id);

            // For public view, show tugas/aktivitas empty or generic
            $tugas = Tugas::where('kelas_id', $id)
                ->orderBy('deadline', 'asc')
                ->get();

            $aktivitas = Aktivitas::where('kelas_id', $id)
                ->orderBy('waktu', 'desc')
                ->get();
        }

        return view('kelas.detail', compact('kelas', 'tugas', 'aktivitas'));
    }
}