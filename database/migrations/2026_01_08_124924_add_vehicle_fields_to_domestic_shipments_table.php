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
              Schema::table('domestic_shipments', function (Blueprint $table) {

            $table->enum('vehicle_type', ['own', 'rented'])
                  ->nullable()
                  ->after('bill_type');

            $table->foreignId('vehicle_hire_id')
                  ->nullable()
                  ->after('vehicle_type')
                  ->constrained('vehicle_hires')
                  ->nullOnDelete();

            $table->string('vehicle_number')->nullable()->after('vehicle_hire_id');
            $table->string('driver_name')->nullable()->after('vehicle_number');
            $table->string('driver_number')->nullable()->after('driver_name');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('domestic_shipments', function (Blueprint $table) {
            //
        });
    }
};
