<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Notification;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EnrollmentController extends Controller
{
    // Tampilkan form join kelas (untuk siswa)
    public function showJoinForm()
    {
        if (Auth::user()->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang bisa join kelas.');
        }

        return view('kelas.join');
    }

    // Proses join kelas dengan kode
    public function joinKelas(Request $request)
    {
        if (Auth::user()->role !== 'siswa') {
            return redirect()->route('dashboard')->with('error', 'Hanya siswa yang bisa join kelas.');
        }

        $request->validate([
            'kode_kelas' => 'required|string|size:8'
        ]);

        $kodeKelas = strtoupper($request->kode_kelas);
        $kelas = Kelas::where('kode_kelas', $kodeKelas)->first();

        if (!$kelas) {
            return back()->with('error', 'Kode kelas tidak ditemukan. Periksa kembali kode yang Anda masukkan.');
        }

        // Cek apakah sudah terdaftar
        $existing = DB::table('user_kelas')
            ->where('user_id', Auth::id())
            ->where('kelas_id', $kelas->id)
            ->first();

        if ($existing) {
            if ($existing->status === 'approved') {
                return back()->with('info', 'Anda sudah terdaftar di kelas ini.');
            } elseif ($existing->status === 'pending') {
                return back()->with('info', 'Permintaan join Anda masih menunggu persetujuan guru.');
            } elseif ($existing->status === 'rejected') {
                return back()->with('error', 'Permintaan join Anda ditolak oleh guru.');
            }
        }

        // Insert enrollment dengan status pending
        DB::table('user_kelas')->insert([
            'user_id' => Auth::id(),
            'kelas_id' => $kelas->id,
            'status' => 'pending',
            'role' => 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kirim notifikasi ke guru (guru yang tercatat di field guru)
        // Cari user guru berdasarkan nama
        $guru = User::where('name', $kelas->guru)->where('role', 'guru')->first();
        if ($guru) {
            Notification::create([
                'user_id' => $guru->id,
                'kelas_id' => $kelas->id,
                'title' => 'Permintaan Join Kelas',
                'message' => Auth::user()->name . ' ingin bergabung ke kelas ' . $kelas->nama,
                'type' => 'enrollment',
                'link' => route('kelas.students', $kelas->id),
                'is_read' => false,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Permintaan join kelas berhasil dikirim. Menunggu persetujuan guru.');
    }

    // Tampilkan daftar siswa di kelas (untuk guru)
    public function students($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // Authorization: hanya guru yang mengampu kelas ini
        if (Auth::user()->role !== 'guru' || Auth::user()->name !== $kelas->guru) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Get approved students
        $students = $kelas->students()->get();

        // Get pending enrollments
        $pendingEnrollments = $kelas->pendingEnrollments()->get();

        return view('kelas.students', compact('kelas', 'students', 'pendingEnrollments'));
    }

    // Approve enrollment
    public function approve($kelasId, $userId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // Authorization
        if (Auth::user()->role !== 'guru' || Auth::user()->name !== $kelas->guru) {
            return back()->with('error', 'Anda tidak memiliki akses untuk melakukan ini.');
        }

        DB::table('user_kelas')
            ->where('user_id', $userId)
            ->where('kelas_id', $kelasId)
            ->update([
                'status' => 'approved',
                'updated_at' => now(),
            ]);

        // Kirim notifikasi ke siswa
        $student = User::find($userId);
        if ($student) {
            Notification::create([
                'user_id' => $student->id,
                'kelas_id' => $kelas->id,
                'title' => 'Join Kelas Disetujui',
                'message' => 'Anda telah diterima di kelas ' . $kelas->nama,
                'type' => 'enrollment',
                'link' => route('kelas.detail', $kelas->id),
                'is_read' => false,
            ]);
        }

        return back()->with('success', 'Siswa berhasil diterima di kelas.');
    }

    // Reject enrollment
    public function reject($kelasId, $userId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // Authorization
        if (Auth::user()->role !== 'guru' || Auth::user()->name !== $kelas->guru) {
            return back()->with('error', 'Anda tidak memiliki akses untuk melakukan ini.');
        }

        DB::table('user_kelas')
            ->where('user_id', $userId)
            ->where('kelas_id', $kelasId)
            ->update([
                'status' => 'rejected',
                'updated_at' => now(),
            ]);

        // Kirim notifikasi ke siswa
        $student = User::find($userId);
        if ($student) {
            Notification::create([
                'user_id' => $student->id,
                'kelas_id' => $kelas->id,
                'title' => 'Join Kelas Ditolak',
                'message' => 'Permintaan join ke kelas ' . $kelas->nama . ' ditolak.',
                'type' => 'enrollment',
                'link' => route('kelas.join'),
                'is_read' => false,
            ]);
        }

        return back()->with('success', 'Permintaan enrollment ditolak.');
    }

    // Remove student from class
    public function removeStudent($kelasId, $userId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // Authorization
        if (Auth::user()->role !== 'guru' || Auth::user()->name !== $kelas->guru) {
            return back()->with('error', 'Anda tidak memiliki akses untuk melakukan ini.');
        }

        // Get all tugas IDs from this class
        $tugasIds = $kelas->tugas()->pluck('id');

        // Delete all submissions from this student for this class's assignments
        if ($tugasIds->isNotEmpty()) {
            $deletedSubmissions = Submission::where('user_id', $userId)
                ->whereIn('tugas_id', $tugasIds)
                ->get();

            // Delete files from storage before deleting records
            foreach ($deletedSubmissions as $submission) {
                if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                    Storage::disk('public')->delete($submission->file_path);
                }
            }

            // Delete submission records
            Submission::where('user_id', $userId)
                ->whereIn('tugas_id', $tugasIds)
                ->delete();
        }

        // Remove student from class
        DB::table('user_kelas')
            ->where('user_id', $userId)
            ->where('kelas_id', $kelasId)
            ->delete();

        // Kirim notifikasi ke siswa
        $student = User::find($userId);
        if ($student) {
            Notification::create([
                'user_id' => $student->id,
                'kelas_id' => $kelas->id,
                'title' => 'Dikeluarkan dari Kelas',
                'message' => 'Anda telah dikeluarkan dari kelas ' . $kelas->nama . '. Semua data pengumpulan tugas Anda di kelas ini telah dihapus.',
                'type' => 'enrollment',
                'link' => route('kelas.join'),
                'is_read' => false,
            ]);
        }

        return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas dan semua data submission mereka telah dihapus.');
    }

    // Leave class (untuk siswa)
    public function leaveClass($kelasId)
    {
        if (Auth::user()->role !== 'siswa') {
            return back()->with('error', 'Hanya siswa yang bisa keluar dari kelas.');
        }

        $kelas = Kelas::findOrFail($kelasId);

        // Get all tugas IDs from this class
        $tugasIds = $kelas->tugas()->pluck('id');

        // Delete all submissions from this student for this class's assignments
        if ($tugasIds->isNotEmpty()) {
            $deletedSubmissions = Submission::where('user_id', Auth::id())
                ->whereIn('tugas_id', $tugasIds)
                ->get();

            // Delete files from storage before deleting records
            foreach ($deletedSubmissions as $submission) {
                if ($submission->file_path && Storage::disk('public')->exists($submission->file_path)) {
                    Storage::disk('public')->delete($submission->file_path);
                }
            }

            // Delete submission records
            Submission::where('user_id', Auth::id())
                ->whereIn('tugas_id', $tugasIds)
                ->delete();
        }

        // Remove from class
        DB::table('user_kelas')
            ->where('user_id', Auth::id())
            ->where('kelas_id', $kelasId)
            ->delete();

        return redirect()->route('kelas')->with('success', 'Anda telah keluar dari kelas ' . $kelas->nama . '. Semua data pengumpulan tugas Anda di kelas ini telah dihapus.');
    }
}
