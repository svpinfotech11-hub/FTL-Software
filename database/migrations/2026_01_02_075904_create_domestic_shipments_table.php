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
        Schema::create('domestic_shipments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('shipment_date')->nullable();
            $table->string('courier')->nullable();
            $table->string('airway_no')->nullable();
            $table->string('risk_type')->nullable();
            $table->string('bill_type')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('discretion')->nullable();

            $table->string('consigner_name')->nullable();
            $table->text('consigner_address')->nullable();
            $table->string('consigner_pincode')->nullable();
            $table->string('consigner_state')->nullable();
            $table->string('consigner_city')->nullable();
            $table->string('consigner_contact')->nullable();
            $table->string('consigner_save_to_address_book')->nullable();
            $table->string('consigner_type_of_doc')->nullable();
            $table->string('coll_type')->nullable();
            $table->string('delivery_type')->nullable();

            // Consignee
            $table->string('consignee_name')->nullable();
            $table->string('consignee_company')->nullable();
            $table->text('consignee_address')->nullable();
            $table->string('consignee_pincode')->nullable();
            $table->string('consignee_state')->nullable();
            $table->string('consignee_city')->nullable();
            $table->string('consignee_contact')->nullable();
            $table->string('consignee_save_to_address_book')->nullable();
            $table->string('consignee_type_of_doc')->nullable();

            $table->string('zone')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('tax')->nullable();

            // Measurement
            $table->integer('pkt')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('actual_weight', 10, 2)->nullable();
            $table->decimal('chargeable_weight', 10, 2)->nullable();

            // Charges
            $table->decimal('freight', 10, 2)->default(0);
            $table->decimal('door_collection', 10, 2)->default(0);
            $table->decimal('insurance', 10, 2)->default(0);
            $table->decimal('awb_charge', 10, 2)->default(0);
            $table->decimal('hamali', 10, 2)->default(0);
            $table->decimal('godown_collection', 10, 2)->default(0);
            $table->decimal('eway_charge', 10, 2)->default(0);
            $table->decimal('fuel_surcharge', 10, 2)->default(0);

            $table->decimal('handling_charge', 10, 2)->default(0);
            $table->decimal('door_delivery', 10, 2)->default(0);
            $table->decimal('cod', 10, 2)->default(0);
            $table->decimal('other_charge', 10, 2)->default(0);
            $table->decimal('appt_charge', 10, 2)->default(0);
            $table->decimal('godown_delivery', 10, 2)->default(0);
            $table->decimal('fov_charge', 10, 2)->default(0);

            // Tax
            $table->decimal('sub_total', 10, 2)->default(0);
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('igst', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domestic_shipments');
    }
};
