<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Collection;

class NilaiViewTest extends TestCase
{
    public function test_nilai_view_renders_overall_average_and_submissions()
    {
        $kelasSummaries = collect([
            [
                'kelas' => (object)['id' => 1, 'name' => 'Kelas Unit Test'],
                'total_tugas' => 3,
                'submitted' => 2,
                'average' => 85.5,
            ]
        ]);

        $submissions = collect([
            (object)[
                'tugas' => (object)['judul' => 'Tugas A', 'kelas' => (object)['name' => 'Kelas Unit Test']],
                'submitted_at' => now(),
                'status' => 'submitted',
                'grade' => 90,
                'feedback' => 'Good job',
            ]
        ]);

        $overallAverage = 90;

        $html = view('nilai.index', compact('kelasSummaries', 'submissions', 'overallAverage'))->render();

        $this->assertStringContainsString('Nilai Saya', $html);
        $this->assertStringContainsString('Kelas Unit Test', $html);
        $this->assertStringContainsString('Tugas A', $html);
        $this->assertStringContainsString('Good job', $html);
        $this->assertStringContainsString('90', $html);
    }
}
