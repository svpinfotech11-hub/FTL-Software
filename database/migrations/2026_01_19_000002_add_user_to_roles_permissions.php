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
        Schema::table('roles', function (Blueprint $table) {
            if (!Schema::hasColumn('roles', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->index('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });

        Schema::table('permissions', function (Blueprint $table) {
            if (!Schema::hasColumn('permissions', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->index('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropIndex(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        Schema::table('permissions', function (Blueprint $table) {
            if (Schema::hasColumn('permissions', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropIndex(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
