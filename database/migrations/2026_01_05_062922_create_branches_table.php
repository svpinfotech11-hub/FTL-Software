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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_bank_name')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('warehouse_branch_name')->nullable();
            $table->string('export_invoice_series')->nullable();
            $table->string('import_invoice_series')->nullable();
            $table->string('domestic_invoice_series')->nullable();
            $table->string('domestic_booking_series')->nullable();
            $table->string('domestic_pod_series')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
