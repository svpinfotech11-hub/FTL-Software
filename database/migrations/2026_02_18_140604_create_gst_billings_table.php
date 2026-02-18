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
        Schema::create('gst_billings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');
            $table->unsignedBigInteger('consignor_id');
            $table->unsignedBigInteger('consignee_id');
            $table->unsignedBigInteger('product_id');
            $table->string('po_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('supply_place')->nullable();
            $table->date('supply_date')->nullable();
            $table->string('trans_mode')->nullable();
            $table->string('reverse_charge')->default('No');
            $table->string('uom')->nullable();
            $table->string('description')->nullable();
            $table->string('hsn_code')->nullable();
            $table->decimal('qty', 10, 2)->default(0);
            $table->decimal('rate', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('disc_percent', 5, 2)->default(0);
            $table->decimal('taxable_value', 10, 2)->default(0);
            $table->decimal('gst_percent', 5, 2)->default(0);
            $table->decimal('cgst_amt', 10, 2)->default(0);
            $table->decimal('sgst_amt', 10, 2)->default(0);
            $table->decimal('igst_amt', 10, 2)->default(0);
            $table->decimal('total_amt', 10, 2)->default(0);
            $table->decimal('disc_amt', 10, 2)->default(0);
            $table->decimal('total_tax_amt', 10, 2)->default(0);
            $table->decimal('tot_cgst_amt', 10, 2)->default(0);
            $table->decimal('tot_sgst_amt', 10, 2)->default(0);
            $table->decimal('tot_igst_amt', 10, 2)->default(0);
            $table->decimal('freight', 10, 2)->default(0);
            $table->decimal('others', 10, 2)->default(0);
            $table->decimal('tcs_percent', 5, 2)->default(0);
            $table->decimal('tcs_amt', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->decimal('advance', 10, 2)->default(0);
            $table->decimal('net_amt', 10, 2)->default(0);
            $table->text('narration')->nullable();

            $table->timestamps();

            $table->foreign('consignor_id')->references('id')->on('consigners')->onDelete('cascade');
            $table->foreign('consignee_id')->references('id')->on('consignees')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gst_billings');
    }
};
