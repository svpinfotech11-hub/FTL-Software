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
        Schema::create('shipment_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('domestic_shipment_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_no');
            $table->decimal('invoice_value', 10, 2);
            $table->date('invoice_date');
            $table->integer('quantity');
            $table->string('type_of_parcel');
            $table->string('eway_no')->nullable();
            $table->date('eway_expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_invoices');
    }
};
