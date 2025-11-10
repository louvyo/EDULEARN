<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Kelas;

class KelasPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_sees_classes()
    {
        // create user and a class, attach and visit
        $user = User::factory()->create();

        $kelas = Kelas::create([
            'nama' => 'Kelas Test',
            'deskripsi' => 'Deskripsi',
            'guru' => 'Guru Test',
            'warna' => 'blue',
            'semester' => '2025',
        ]);

        $user->kelas()->attach($kelas->id);

        $response = $this->actingAs($user)->get('/kelas');

        $response->assertStatus(200);
        $response->assertSee('Kelas Test');
    }
}
