<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            $tugas = Tugas::where('user_id', $user->id)
                ->with('kelas')
                ->orderBy('deadline', 'asc')
                ->get();

            $kelas = $user->kelas;
        } else {
            // Public fallback: show no personal tasks and list all classes
            $tugas = collect();
            $kelas = Kelas::all();
        }

        return view('tugas.index', compact('tugas', 'kelas'));
    }
}