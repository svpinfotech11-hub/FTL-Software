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
        Schema::create('freight_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('ledger_id')->nullable();
            $table->string('challan_no')->nullable();
            $table->date('challan_date')->nullable();
            $table->string('licence_no')->nullable();
            $table->string('payable_at')->nullable();
            $table->string('lr_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->decimal('actual_wt', 10, 2)->nullable();
            $table->decimal('charged_wt', 10, 2)->nullable();
            $table->decimal('freight_rate', 10, 2)->nullable();
            $table->string('rate_type')->nullable();
            $table->decimal('total_challan_amt', 10, 2)->nullable();
            $table->decimal('loading', 10, 2)->nullable();
            $table->text('load_remarks')->nullable();
            $table->decimal('uld_amt', 10, 2)->nullable();
            $table->text('uld_remarks')->nullable();
            $table->decimal('detention', 10, 2)->nullable();
            $table->text('det_remarks')->nullable();
            $table->decimal('deduction', 10, 2)->nullable();
            $table->text('ded_remarks')->nullable();
            $table->string('detent_place')->nullable();
            $table->decimal('border_exp', 10, 2)->nullable();
            $table->text('border_remarks')->nullable();
            $table->decimal('others', 10, 2)->nullable();
            $table->text('other_remarks')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('party_name')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('advance_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('diesel_qty', 10, 2)->nullable();
            $table->decimal('diesel_rate', 10, 2)->nullable();
            $table->decimal('advance_amount', 10, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->decimal('total_freight', 10, 2)->nullable();
            $table->decimal('total_packing', 10, 2)->nullable();
            $table->decimal('total_qty', 10, 2)->nullable();
            $table->decimal('total_actual_wt', 10, 2)->nullable();
            $table->decimal('total_charge_wt', 10, 2)->nullable();
            $table->decimal('unloading', 10, 2)->nullable();
            $table->decimal('borderexp', 10, 2)->nullable();
            $table->decimal('others_amt', 10, 2)->nullable();
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->decimal('advance_amt', 10, 2)->nullable();
            $table->decimal('tds_percent', 10, 2)->nullable();
            $table->decimal('tds_amt', 10, 2)->nullable();
            $table->decimal('loading_amt', 10, 2)->nullable();
            $table->decimal('detention_amt', 10, 2)->nullable();
            $table->decimal('deduction_amt', 10, 2)->nullable();
            $table->decimal('manual_amt', 10, 2)->nullable();
            $table->decimal('net_advance_amt', 10, 2)->nullable();
            $table->decimal('balance_amt', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freight_challans');
    }
};
