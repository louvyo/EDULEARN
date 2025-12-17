<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('users', 'provider')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('provider');
            });
        }
        if (Schema::hasColumn('users', 'provider_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('provider_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'provider')) {
                $table->string('provider')->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'provider_id')) {
                $table->string('provider_id')->nullable()->after('provider');
            }
        });
    }
};
