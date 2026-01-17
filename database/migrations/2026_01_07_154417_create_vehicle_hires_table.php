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
        Schema::create('vehicle_hires', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->date('hire_date')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('driver_details')->nullable();

            $table->string('route_from')->nullable();
            $table->string('route_to')->nullable();

            $table->string('lr_manifest_no')->nullable();

            $table->decimal('hire_rate', 10, 2)->nullable();
            $table->decimal('advance_paid', 10, 2)->nullable();
            $table->decimal('balance_payable', 10, 2)->nullable();

            $table->string('payment_status')->nullable(); 
            // Pending | Partial | Paid

            // Attachments
            $table->string('rc_document')->nullable();
            $table->string('insurance_document')->nullable();
            $table->string('pan_document')->nullable();
            $table->string('other_document')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_hires');
    }
};
