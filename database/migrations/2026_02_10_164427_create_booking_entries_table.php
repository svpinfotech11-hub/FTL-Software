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
        Schema::create('booking_entries', function (Blueprint $table) {
            $table->id();

            // LR Details
            $table->string('lr_no')->unique();
            $table->date('lr_date');
            $table->string('ref_lr_no')->nullable();
            // $table->string('pm')->nullable();

            // Source Ledger
            $table->foreignId('source_ledger_id')->constrained('ledgers')->onDelete('cascade');
            $table->string('source_address')->nullable();
            $table->string('source_state')->nullable();
            $table->string('source_city')->nullable();
            $table->string('source_district')->nullable();

            // Destination Ledger
            $table->foreignId('destination_ledger_id')->constrained('ledgers')->onDelete('cascade');
            $table->string('destination_address')->nullable();
            $table->string('destination_state')->nullable();
            $table->string('destination_city')->nullable();
            $table->string('destination_district')->nullable();

            /* ================= CONSIGNOR ================= */
            $table->string('consignor_ledger_name')->nullable(); 
            $table->string('consignor_address1')->nullable();
            $table->string('consignor_address2')->nullable();
            $table->string('consignor_state')->nullable();
            $table->string('consignor_city')->nullable();
            $table->string('consignor_gstin')->nullable();
            $table->string('consignor_phone')->nullable();
            $table->string('consignor_mobile')->nullable();

            /* ================= CONSIGNEE ================= */
            $table->string('consignee_ledger_name')->nullable();
            $table->string('consignee_address1')->nullable();
            $table->string('consignee_address2')->nullable();
            $table->string('consignee_state')->nullable();
            $table->string('consignee_city')->nullable();
            $table->string('consignee_gstin')->nullable();
            $table->string('consignee_phone')->nullable();
            $table->string('consignee_mobile')->nullable();

            // Billing / Vehicle
            $table->string('vehicle_no')->nullable();
            $table->string('owner_name')->nullable();

            // Party Invoice
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();
            $table->decimal('value_of_goods', 12, 2)->default(0);
            $table->string('eway_bill_no')->nullable();
            $table->date('ewb_exp_date')->nullable();

            // Product Details
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // Charges
            $table->decimal('freight', 12, 2)->default(0);
            $table->decimal('hamali', 12, 2)->default(0);
            $table->decimal('pre_bhadha', 12, 2)->default(0);
            $table->decimal('bilty_charge', 12, 2)->default(0);
            $table->decimal('colle_charges', 12, 2)->default(0);
            $table->decimal('cpc', 12, 2)->default(0);
            $table->decimal('other_charge', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            // GST
            $table->decimal('cgst', 12, 2)->default(0);
            $table->decimal('sgst', 12, 2)->default(0);
            $table->decimal('igst', 12, 2)->default(0);

            $table->decimal('advance', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_entries');
    }
};
