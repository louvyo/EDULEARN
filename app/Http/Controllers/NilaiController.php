<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NilaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isGuru = $user && $user->role === 'guru';
        
        if ($isGuru) {
            // For teachers, show all submissions that need grading
            $submissions = Submission::with(['tugas.kelas', 'user'])
                ->orderByDesc('submitted_at')
                ->get();
                
            $ungradedCount = Submission::whereNull('grade')->count();
            $totalSubmissions = $submissions->count();
            $overallAverage = $submissions->whereNotNull('grade')->avg('grade');
            $kelasSummaries = collect(); // Empty for guru view
            
            return view('nilai.index', compact('submissions', 'isGuru', 'ungradedCount', 'totalSubmissions', 'overallAverage', 'kelasSummaries'));
        } else {
            // For students, show their submissions & grades
            $userId = auth()->id() ?? User::value('id');

            $submissions = collect();
            if ($userId) {
                $submissions = Submission::with(['tugas.kelas'])
                    ->where('user_id', $userId)
                    ->orderByDesc('submitted_at')
                    ->get();
            }

            // Group by kelas and compute summary per class
            $byKelas = $submissions->groupBy(function ($s) {
                return optional($s->tugas->kelas)->id ?? 0;
            });

            $kelasSummaries = collect();
            foreach ($byKelas as $kelasId => $group) {
                $kelasModel = $group->first()->tugas->kelas ?? null;
                $totalTugas = Tugas::where('kelas_id', $kelasId)->count();
                $submitted = $group->count();
                $avg = $group->whereNotNull('grade')->avg('grade');

                $kelasSummaries->push([
                    'kelas' => $kelasModel,
                    'total_tugas' => $totalTugas,
                    'submitted' => $submitted,
                    'average' => $avg,
                ]);
            }

            $overallAverage = $submissions->whereNotNull('grade')->avg('grade');

            return view('nilai.index', compact('kelasSummaries', 'submissions', 'overallAverage', 'isGuru'));
        }
    }
}
