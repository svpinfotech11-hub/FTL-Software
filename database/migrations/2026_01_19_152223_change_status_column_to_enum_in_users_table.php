<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change status column from boolean to enum
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('active', 'inactive', 'suspended', 'pending') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Change status column back to boolean
        DB::statement("ALTER TABLE users MODIFY COLUMN status BOOLEAN NOT NULL DEFAULT 1");
    }
};
