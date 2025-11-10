<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add kode_kelas to kelas table (hanya jika belum ada)
        Schema::table('kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('kelas', 'kode_kelas')) {
                $table->string('kode_kelas', 8)->after('nama');
            }
        });
        
        // Add unique constraint (terpisah untuk avoid conflict)
        Schema::table('kelas', function (Blueprint $table) {
            $table->unique('kode_kelas');
        });

        // Add status to user_kelas table for enrollment approval
        Schema::table('user_kelas', function (Blueprint $table) {
            if (!Schema::hasColumn('user_kelas', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('kelas_id');
            }
            if (!Schema::hasColumn('user_kelas', 'role')) {
                $table->enum('role', ['guru', 'siswa'])->default('siswa')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn('kode_kelas');
        });

        Schema::table('user_kelas', function (Blueprint $table) {
            $table->dropColumn(['status', 'role']);
        });
    }
};
