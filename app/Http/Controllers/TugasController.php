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
            'file' => 'nullable|file|max:10240|mimes:pdf,doc,docx,txt,zip,jpg,jpeg,png,ppt,pptx,xls,xlsx',
            'content' => 'nullable|string|max:2000',
        ]);

        $userId = auth()->id() ?? User::value('id');

        if (! $userId) {
            return redirect()->route('tugas.show', $tugas->id)
                ->with('error', 'Tidak ada user untuk dikaitkan dengan pengumpulan.');
        }

        $filePath = null;
        $fileName = null;
        $fileType = null;
        $fileSize = null;
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('submissions', 'public');
            $fileName = $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
        }

        $status = 'submitted';
        if ($tugas->deadline && now()->gt($tugas->deadline)) {
            $status = 'late';
        }

        $submission = Submission::create([
            'tugas_id' => $tugas->id,
            'user_id' => $userId,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'content' => $request->input('content'),
            'submitted_at' => now(),
            'status' => $status,
        ]);

        return redirect()->route('tugas.show', $tugas->id)->with('success', 'Tugas berhasil dikumpulkan.');
    }

    public function download($id)
    {
        $submission = Submission::findOrFail($id);
        
        // Check if user owns this submission or is admin
        if (auth()->id() !== $submission->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if (!$submission->file_path) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $submission->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, $submission->file_name);
    }
}