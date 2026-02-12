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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            
            // Ledger details
            $table->string('ledger_group')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('party_name')->nullable();
            $table->string('party_alias')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('iec_no')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('rc_no')->nullable();
            $table->string('license_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            
            // Opening balance
            $table->decimal('opening_bal', 15, 2)->default(0);
            $table->enum('opening_type', ['DR', 'CR'])->default('DR');
            
            $table->string('arn_no')->nullable();
            $table->string('exim_code')->nullable();

            // File uploads
            $table->string('pan_upload')->nullable();
            $table->string('declaration_upload')->nullable();
            $table->string('aadhar_upload')->nullable();
            $table->string('gst_upload')->nullable();
            $table->string('office_photo')->nullable();
            
            // Broker Bank Details
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
