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
        Schema::table('booking_entries', function (Blueprint $table) {
            $table->string('lr_type')->nullable()->after('lr_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking_entries', function (Blueprint $table) {
            $table->dropColumn('lr_type');
        });
    }
};
