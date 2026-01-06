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
        Schema::table('domestic_shipments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id'); // or after any column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domestic_shipments', function (Blueprint $table) {
        
        });
    }
};
