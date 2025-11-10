<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Database\Seeders\UserSeeder::class,
            \Database\Seeders\KelasSeeder::class,
            \Database\Seeders\TugasSeeder::class,
            \Database\Seeders\AktivitasSeeder::class,
            \Database\Seeders\NotificationSeeder::class,
        ]);
    }
}
