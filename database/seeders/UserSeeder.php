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
        User::firstOrCreate([
            'email' => 'murid@edulearn.com',
        ], [
            'name' => 'Murid',
            'password' => bcrypt('password'),
        ]);

        // Guru
        User::firstOrCreate([
            'email' => 'guru@edulearn.com',
        ], [
            'name' => 'Guru',
            'password' => bcrypt('password'),
        ]);

        // Test user (backward compatibility)
        User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);
    }
}
