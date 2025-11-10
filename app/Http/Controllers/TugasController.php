<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kelas;
use App\Models\Submission;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';
        
        // Filter classes and assignments based on role
        if ($isGuru) {
            // Guru: show all classes and all assignments
            $kelas = Kelas::all();
            $query = Tugas::with(['kelas', 'user'])->orderBy('deadline', 'asc');
        } else {
            // Siswa: only show enrolled classes and their assignments
            $kelas = $user->kelasAsSiswa()->get();
            $kelasIds = $kelas->pluck('id');
            
            $query = Tugas::with(['kelas', 'user'])
                ->whereIn('kelas_id', $kelasIds)
                ->orderBy('deadline', 'asc');
        }

        // Apply filter by class if selected
        if (request()->filled('kelas_id')) {
            $query->where('kelas_id', request('kelas_id'));
        }

        $tugas = $query->get();
        
        // Add submission status for students
        if (!$isGuru) {
            $tugas->each(function($task) use ($user) {
                $task->user_submission = Submission::where('tugas_id', $task->id)
                    ->where('user_id', $user->id)
                    ->latest('submitted_at')
                    ->first();
            });
        }

        return view('tugas.index', compact('tugas', 'kelas', 'isGuru'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';
        
        $tugas = Tugas::with(['kelas', 'user'])->findOrFail($id);

        // Get latest submission for current user (if auth exists)
        $userId = auth()->id() ?? User::value('id');

        $submission = null;
        if ($userId) {
            $submission = Submission::where('tugas_id', $tugas->id)
                ->where('user_id', $userId)
                ->latest('submitted_at')
                ->first();
        }
        
        // For teachers, get all submissions for this assignment
        $submissions = null;
        if ($isGuru) {
            $submissions = Submission::with('user')
                ->where('tugas_id', $tugas->id)
                ->orderBy('submitted_at', 'desc')
                ->get();
        }

        return view('tugas.show', compact('tugas', 'submission', 'isGuru', 'submissions'));
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
    
    /**
     * Show the form for creating a new assignment (Guru only)
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $kelas = Kelas::all();
        
        return view('tugas.create', compact('kelas'));
    }
    
    /**
     * Store a newly created assignment (Guru only)
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date',
            'poin' => 'nullable|integer|min:0|max:100',
        ]);
        
        $tugas = Tugas::create([
            'kelas_id' => $request->kelas_id,
            'user_id' => $user->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'poin' => $request->poin ?? 100,
        ]);
        
        // Kirim notifikasi ke semua siswa di kelas
        $kelas = Kelas::find($request->kelas_id);
        $students = $kelas->students()->get();
        
        foreach ($students as $student) {
            Notification::create([
                'user_id' => $student->id,
                'type' => 'tugas_baru',
                'title' => 'Tugas Baru: ' . $tugas->judul,
                'message' => 'Guru ' . $user->name . ' membuat tugas baru di kelas ' . $kelas->nama,
                'link' => route('tugas.show', $tugas->id),
                'is_read' => false,
            ]);
        }
        
        return redirect()->route('tugas.show', $tugas->id)
            ->with('success', 'Tugas berhasil dibuat!');
    }
    
    /**
     * Show the form for editing an assignment (Guru only)
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $tugas = Tugas::with('kelas')->findOrFail($id);
        $kelas = Kelas::all();
        
        return view('tugas.edit', compact('tugas', 'kelas'));
    }
    
    /**
     * Update the specified assignment (Guru only)
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date',
            'poin' => 'nullable|integer|min:0|max:100',
        ]);
        
        $tugas = Tugas::findOrFail($id);
        
        $tugas->update([
            'kelas_id' => $request->kelas_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deadline' => $request->deadline,
            'poin' => $request->poin ?? 100,
        ]);
        
        return redirect()->route('tugas.show', $tugas->id)
            ->with('success', 'Tugas berhasil diperbarui!');
    }
    
    /**
     * Remove the specified assignment (Guru only)
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        
        return redirect()->route('tugas')
            ->with('success', 'Tugas berhasil dihapus!');
    }
    
    /**
     * Grade a student submission (Guru only)
     */
    public function gradeSubmission(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string|max:1000',
        ]);
        
        $submission = Submission::findOrFail($id);
        
        $submission->update([
            'grade' => $request->grade,
            'feedback' => $request->feedback,
            'graded_at' => now(),
            'graded_by' => $user->id,
        ]);
        
        // Kirim notifikasi ke siswa
        $tugas = $submission->tugas;
        Notification::create([
            'user_id' => $submission->user_id,
            'type' => 'nilai_keluar',
            'title' => 'Tugas Dinilai',
            'message' => 'Tugas "' . $tugas->judul . '" telah dinilai. Nilai Anda: ' . $request->grade,
            'link' => route('tugas.show', $tugas->id),
            'is_read' => false,
        ]);
        
        return back()->with('success', 'Nilai berhasil diberikan!');
    }
}