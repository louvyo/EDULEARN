<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AktivitasController extends Controller
{
    /**
     * Show the form for creating a new aktivitas (materi)
     */
    public function create($kelasId)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $kelas = Kelas::findOrFail($kelasId);

        return view('aktivitas.create', compact('kelas'));
    }

    /**
     * Store a newly created aktivitas
     */
    public function store(Request $request, $kelasId)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:materi,pengumuman',
            'file' => 'nullable|file|max:10240', // 10MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('aktivitas', $fileName, 'public');
        }

        Aktivitas::create([
            'kelas_id' => $kelasId,
            'user_id' => $user->id,
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? '',
            'tipe' => $validated['tipe'],
            'file_path' => $filePath,
            'waktu' => now()->setTimezone('Asia/Makassar'),
        ]);

        return redirect()->route('kelas.detail', $kelasId)
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    /**
     * Remove the specified aktivitas
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $aktivitas = Aktivitas::findOrFail($id);
        
        // Delete file if exists
        if ($aktivitas->file_path) {
            Storage::disk('public')->delete($aktivitas->file_path);
        }

        $kelasId = $aktivitas->kelas_id;
        $aktivitas->delete();

        return redirect()->route('kelas.detail', $kelasId)
            ->with('success', 'Materi berhasil dihapus!');
    }

    /**
     * Show edit form for aktivitas
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $aktivitas = Aktivitas::findOrFail($id);
        $kelas = Kelas::findOrFail($aktivitas->kelas_id);

        return view('aktivitas.edit', compact('aktivitas', 'kelas'));
    }

    /**
     * Update an aktivitas
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Unauthorized');
        }

        $aktivitas = Aktivitas::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'required|in:materi,pengumuman',
            'file' => 'nullable|file|max:10240',
            'remove_file' => 'nullable|boolean',
        ]);

        // Handle file removal
        if ($request->boolean('remove_file') && $aktivitas->file_path) {
            Storage::disk('public')->delete($aktivitas->file_path);
            $aktivitas->file_path = null;
        }

        // Handle file replace
        if ($request->hasFile('file')) {
            if ($aktivitas->file_path) {
                Storage::disk('public')->delete($aktivitas->file_path);
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $aktivitas->file_path = $file->storeAs('aktivitas', $fileName, 'public');
        }

        $aktivitas->judul = $validated['judul'];
        $aktivitas->deskripsi = $validated['deskripsi'] ?? '';
        $aktivitas->tipe = $validated['tipe'];
        $aktivitas->save();

        return redirect()->route('kelas.detail', $aktivitas->kelas_id)
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Download attachment for an aktivitas (materi/pengumuman)
     */
    public function download($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);

        if (!$aktivitas->file_path) {
            return back()->with('error', 'File tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($aktivitas->file_path)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        // Authorization: only class teacher or approved students can download
        $user = Auth::user();
        if (!$user) abort(403, 'Unauthorized');
        $kelas = Kelas::find($aktivitas->kelas_id);
        $isAuthorized = false;
        if ($kelas) {
            $isAuthorized = $kelas->users()
                ->where('user_id', $user->id)
                ->where(function($q){
                    $q->where('user_kelas.role','guru')
                      ->orWhere(function($q2){
                          $q2->where('user_kelas.role','siswa')
                             ->where('user_kelas.status','approved');
                      });
                })->exists();
        }
        if (!$isAuthorized) abort(403, 'Unauthorized');

        $downloadName = basename($aktivitas->file_path);
        $absolutePath = Storage::disk('public')->path($aktivitas->file_path);
        return response()->download($absolutePath, $downloadName);
    }
}
