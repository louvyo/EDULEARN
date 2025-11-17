<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('submissions', 'tugas_id') || !Schema::hasColumn('submissions', 'user_id')) {
                return; // safety
            }
            $table->unique(['tugas_id', 'user_id'], 'submissions_tugas_user_unique');
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropUnique('submissions_tugas_user_unique');
        });
    }
};
