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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->string('vehicle_registration')->nullable();
            $table->string('vehicle_chesis')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->date('vehicle_puc_date')->nullable();
            $table->date('vehicle_fitness_exp_date')->nullable();
            $table->date('vehicle_permit_renewal_date')->nullable();
            $table->date('vehicle_insurance_renew_date')->nullable();
            $table->string('vehicle_capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
