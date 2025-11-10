<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class GenerateKodeKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = Kelas::all();
        
        foreach ($kelasList as $kelas) {
            if (empty($kelas->kode_kelas)) {
                $kelas->kode_kelas = Kelas::generateKodeKelas();
                $kelas->save();
                echo "Generated kode for: {$kelas->nama} - {$kelas->kode_kelas}\n";
            }
        }
        
        echo "Done generating kode_kelas!\n";
    }
}
