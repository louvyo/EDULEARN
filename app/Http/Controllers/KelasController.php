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
        $isGuru = $user && $user->role === 'guru';
        
        // For teachers, show only classes they teach (via pivot as 'guru')
        // For students, show only classes they're enrolled in (approved)
        if ($isGuru) {
            $kelasIds = $user->kelasAsGuru()->pluck('kelas.id');
            $classes = Kelas::whereIn('id', $kelasIds)
                ->orderBy('created_at', 'desc')
                ->paginate(9);

            // Get latest activities only from teacher's classes
            $latestActivities = Aktivitas::with(['kelas', 'user'])
                ->whereIn('kelas_id', $kelasIds)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        } else {
            // Students: only show enrolled classes (approved status)
            $kelasIds = $user->kelasAsSiswa()->pluck('kelas.id');
            $classes = Kelas::whereIn('id', $kelasIds)
                ->orderBy('created_at', 'desc')
                ->paginate(9);
            
            // Add progress data for each class for students
            $classes->getCollection()->transform(function ($kelas) use ($user) {
                // Calculate progress based on submitted assignments
                $totalTugas = $kelas->tugas()->count();
                $tugasSelesai = \App\Models\Submission::where('user_id', $user->id)
                    ->whereIn('tugas_id', $kelas->tugas()->pluck('id'))
                    ->count();
                
                $kelas->progress = $totalTugas > 0 ? round(($tugasSelesai / $totalTugas) * 100) : 0;
                return $kelas;
            });
            
            // Get latest activities only from enrolled classes
            $latestActivities = Aktivitas::with(['kelas', 'user'])
                ->whereIn('kelas_id', $kelasIds)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        }

        return view('kelas.index', compact('classes', 'latestActivities', 'isGuru'));
    }

    /**
     * Show the class detail page for a class the user belongs to.
     */
    public function show($id)
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';
        
        // Authorization: user must belong to the class (as guru or approved siswa)
        $allowed = $isGuru
            ? $user->kelasAsGuru()->where('kelas.id', $id)->exists()
            : $user->kelasAsSiswa()->where('kelas.id', $id)->exists();

        if (!$allowed) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini');
        }

        $kelasModel = Kelas::with(['tugas', 'aktivitas'])->findOrFail($id);

        // Show tugas/aktivitas for the class
        $tugas = Tugas::where('kelas_id', $id)
            ->orderBy('deadline', 'asc')
            ->get();

        $aktivitas = Aktivitas::where('kelas_id', $id)
            ->orderBy('waktu', 'desc')
            ->get();

        // Format data for view
        $kelas = [
            'id' => $kelasModel->id,
            'name' => $kelasModel->nama,
            'teacher' => $kelasModel->guru,
            'semester' => $kelasModel->semester,
            'color' => $kelasModel->warna,
            'kode_kelas' => $kelasModel->kode_kelas,
            'code' => 'KLS-' . str_pad($kelasModel->id, 4, '0', STR_PAD_LEFT),
            'schedule' => 'Senin, 08:00 - 10:00',
            'room' => 'Lab Komputer 1',
            'assignments' => $tugas->filter(function($t) {
                // Only show upcoming assignments (deadline hasn't passed)
                return $t->deadline && $t->deadline->isFuture();
            })->map(function($t) {
                return [
                    'id' => $t->id,
                    'title' => $t->judul,
                    'description' => $t->deskripsi,
                    'points' => $t->poin ?? 100,
                    'time' => $t->created_at->diffForHumans(),
                    'due_date' => $t->deadline->format('d M Y'),
                ];
            })->values()->toArray(),
            'materials' => $aktivitas->where('tipe', 'materi')->map(function($a) {
                return [
                    'id' => $a->id,
                    'title' => $a->judul,
                    'description' => $a->deskripsi ?? 'Materi pembelajaran',
                    'time' => $a->created_at->diffForHumans(),
                    'file' => basename($a->file_path ?? '-'),
                    'file_path' => $a->file_path,
                ];
            })->values()->toArray(),
            'announcements' => $aktivitas->where('tipe', 'pengumuman')->map(function($a) {
                return [
                    'id' => $a->id,
                    'title' => $a->judul,
                    'description' => $a->deskripsi ?? '',
                    'time' => $a->created_at->diffForHumans(),
                    'file' => basename($a->file_path ?? '-'),
                    'file_path' => $a->file_path,
                ];
            })->values()->toArray(),
        ];

        return view('kelas.detail', compact('kelas', 'tugas', 'aktivitas', 'isGuru'));
    }
    
    /**
     * Show the form for creating a new class (Guru only)
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        // Generate random vibrant color with HSL
        $hue = rand(0, 360); // Random hue (color)
        $saturation = rand(60, 90); // High saturation for vibrant colors
        $lightness = rand(45, 65); // Medium lightness for good contrast
        
        $defaultColor = "hsl($hue, $saturation%, $lightness%)";
        
        return view('kelas.create', compact('defaultColor'));
    }
    
    /**
     * Store a newly created class (Guru only)
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'semester' => 'required|string|max:100',
            'warna' => 'required|string|max:50', // Accept any color format (hex, rgb, hsl)
            'deskripsi' => 'nullable|string',
        ]);
        
        $kelas = Kelas::create([
            'nama' => $request->nama,
            'guru' => $user->name, // Auto-fill from logged in user
            'semester' => $request->semester,
            'warna' => $request->warna,
            'deskripsi' => $request->deskripsi,
        ]);
        
        // Attach teacher as owner in pivot
        $kelas->users()->attach($user->id, [
            'role' => 'guru',
            'status' => 'approved',
        ]);
        
        return redirect()->route('kelas.detail', $kelas->id)
            ->with('success', 'Kelas berhasil dibuat!');
    }
    
    /**
     * Show the form for editing a class (Guru only)
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $kelas = Kelas::findOrFail($id);
        
        return view('kelas.edit', compact('kelas'));
    }
    
    /**
     * Update the specified class (Guru only)
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'semester' => 'required|string|max:100',
            'warna' => 'required|string|max:50', // Accept any color format
            'deskripsi' => 'nullable|string',
        ]);
        
        $kelas = Kelas::findOrFail($id);
        
        // Don't update 'guru' field - keep it as is
        $kelas->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'warna' => $request->warna,
            'deskripsi' => $request->deskripsi,
        ]);
        
        return redirect()->route('kelas.detail', $kelas->id)
            ->with('success', 'Kelas berhasil diperbarui!');
    }
    
    /**
     * Remove the specified class (Guru only)
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }
        
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        
        return redirect()->route('kelas')
            ->with('success', 'Kelas berhasil dihapus!');
    }
}