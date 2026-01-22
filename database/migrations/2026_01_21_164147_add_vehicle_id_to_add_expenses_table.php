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
        Schema::table('add_expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicle_id')->nullable()->after('driver_id');
            $table->string('paid_by')->nullable()->after('expense_type');
            $table->string('vehicle_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_expenses', function (Blueprint $table) {
            $table->dropColumn('vehicle_id');
        });
    }
};
