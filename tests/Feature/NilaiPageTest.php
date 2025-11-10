<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Submission;

class NilaiPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_sees_submission_and_grade_on_nilai_page()
    {
        $user = User::factory()->create();

        $kelas = Kelas::create([
            'nama' => 'Kelas Test Nilai',
            'deskripsi' => 'Deskripsi',
            'guru' => 'Guru Test',
            'warna' => 'blue',
            'semester' => '2025',
        ]);

        $tugas = Tugas::create([
            'judul' => 'Tugas Penilaian 1',
            'deskripsi' => 'Deskripsi tugas',
            'kelas_id' => $kelas->id,
            'user_id' => $user->id,
            'deadline' => now()->addDays(3),
            'prioritas' => 'sedang',
            'status' => 'belum_dikerjakan',
        ]);

        $submission = Submission::create([
            'tugas_id' => $tugas->id,
            'user_id' => $user->id,
            'file_path' => null,
            'content' => 'Jawaban saya',
            'submitted_at' => now(),
            'status' => 'submitted',
            'grade' => 88,
            'feedback' => 'Bagus',
        ]);

        $response = $this->actingAs($user)->get('/nilai');

        $response->assertStatus(200);
        $response->assertSee('Tugas Penilaian 1');
        $response->assertSee('88');
        $response->assertSee('Bagus');
    }

    public function test_student_with_no_submissions_sees_empty_message()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/nilai');

        $response->assertStatus(200);
        $response->assertSee('Belum ada pengumpulan.');
    }
}
