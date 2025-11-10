<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kelas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        // Auth removed: no personal tasks, list all classes
        $tugas = collect();
        $kelas = Kelas::all();

        return view('tugas.index', compact('tugas', 'kelas'));
    }
}