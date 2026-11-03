<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users') || Schema::hasColumn('users', 'pm_user_uid')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('pm_user_uid')->nullable()->index();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'pm_user_uid')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('pm_user_uid');
            });
        }
    }
};
