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
        Schema::create('loading_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('challan_no')->unique();
            $table->date('challan_date')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('vehicle_owner')->nullable();
            $table->string('source')->nullable();
            $table->string('source_state')->nullable();
            $table->string('source_city')->nullable();
            $table->string('source_district')->nullable();
            $table->string('destination')->nullable();
            $table->string('destination_state')->nullable();
            $table->string('destination_city')->nullable();
            $table->string('destination_district')->nullable();
            $table->string('firm_branch')->nullable();
            $table->string('license_no')->nullable();
            $table->string('challan_type')->nullable();
            $table->decimal('lr_no', 10, 2)->nullable();
            $table->decimal('gr_no', 10, 2)->nullable();
            $table->decimal('total_freight', 10, 2)->nullable();
            $table->decimal('truck_freight', 10, 2)->nullable();
            $table->decimal('advance', 10, 2)->nullable();
            $table->decimal('commission_amount', 10, 2)->nullable();
            $table->decimal('lc_charge', 10, 2)->nullable();
            $table->decimal('dc_charge', 10, 2)->nullable();
            $table->decimal('cf_charge', 10, 2)->nullable();
            $table->decimal('tot_crossing', 10, 2)->nullable();
            $table->decimal('net_amount', 10, 2)->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_challans');
    }
};
