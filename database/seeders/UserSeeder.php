<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Siswa
        User::updateOrCreate([
            'email' => 'murid@edulearn.com',
        ], [
            'name' => 'Ahmad Fauzi',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);

        // Guru
        User::updateOrCreate([
            'email' => 'guru@edulearn.com',
        ], [
            'name' => 'Dr. Siti Nurhaliza',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        // Test user (backward compatibility)
        User::updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'role' => 'siswa',
        ]);
    }
}
