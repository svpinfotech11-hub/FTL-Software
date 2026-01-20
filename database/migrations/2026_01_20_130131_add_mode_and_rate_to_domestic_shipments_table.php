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
            $table->enum('mode', ['FTL', 'Road Transport'])->nullable()->after('vehicle_hire_id');
            $table->decimal('rate', 10, 2)->nullable()->after('mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domestic_shipments', function (Blueprint $table) {
            $table->dropColumn(['mode', 'rate']);
        });
    }
};
