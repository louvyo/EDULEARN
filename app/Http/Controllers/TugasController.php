<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        // List tugas (optionally filter by kelas)
        $kelas = Kelas::all();

        $query = Tugas::with(['kelas', 'user'])->orderBy('deadline', 'asc');

        if (request()->filled('kelas_id')) {
            $query->where('kelas_id', request('kelas_id'));
        }

        $tugas = $query->get();

        return view('tugas.index', compact('tugas', 'kelas'));
    }

    public function show($id)
    {
        $tugas = Tugas::with(['kelas', 'user'])->findOrFail($id);

        // get latest submission for current user (if auth exists)
    $userId = auth()->id() ?? User::value('id');

        $submission = null;
        if ($userId) {
            $submission = Submission::where('tugas_id', $tugas->id)
                ->where('user_id', $userId)
                ->latest('submitted_at')
                ->first();
        }

        return view('tugas.show', compact('tugas', 'submission'));
    }

    public function submit(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt,zip,jpg,jpeg,png',
            'content' => 'nullable|string|max:2000',
        ]);

    $userId = auth()->id() ?? User::value('id');

        if (! $userId) {
            return redirect()->route('tugas.show', $tugas->id)
                ->with('error', 'Tidak ada user untuk dikaitkan dengan pengumpulan.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        $status = 'submitted';
        if ($tugas->deadline && now()->gt($tugas->deadline)) {
            $status = 'late';
        }

        $submission = Submission::create([
            'tugas_id' => $tugas->id,
            'user_id' => $userId,
            'file_path' => $filePath,
            'content' => $request->input('content'),
            'submitted_at' => now(),
            'status' => $status,
        ]);

        return redirect()->route('tugas.show', $tugas->id)->with('success', 'Tugas berhasil dikumpulkan.');
    }
}