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
          Schema::table('domestic_shipments', function (Blueprint $table) {

        // Consigner columns
        $table->dropColumn([
            'consigner_name',
            'consigner_address',
            'consigner_pincode',
            'consigner_state',
            'consigner_city',
            'consigner_contact',
            'consigner_save_to_address_book',
            'consigner_type_of_doc',
            'coll_type',
            'delivery_type',
        ]);

        // Consignee columns
        $table->dropColumn([
            'consignee_name',
            'consignee_company',
            'consignee_address',
            'consignee_pincode',
            'consignee_state',
            'consignee_city',
            'consignee_contact',
            'consignee_save_to_address_book',
            'consignee_type_of_doc',
            'zone',
            'gst_no',
        ]);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('domestic_shipments', function (Blueprint $table) {

        $table->string('consigner_name')->nullable();
        $table->text('consigner_address')->nullable();
        $table->string('consigner_pincode')->nullable();
        $table->string('consigner_state')->nullable();
        $table->string('consigner_city')->nullable();
        $table->string('consigner_contact')->nullable();
        $table->boolean('consigner_save_to_address_book')->default(0);
        $table->string('consigner_type_of_doc')->nullable();
        $table->string('coll_type')->nullable();
        $table->string('delivery_type')->nullable();

        $table->string('consignee_name')->nullable();
        $table->string('consignee_company')->nullable();
        $table->text('consignee_address')->nullable();
        $table->string('consignee_pincode')->nullable();
        $table->string('consignee_state')->nullable();
        $table->string('consignee_city')->nullable();
        $table->string('consignee_contact')->nullable();
        $table->boolean('consignee_save_to_address_book')->default(0);
        $table->string('consignee_type_of_doc')->nullable();
        $table->string('zone')->nullable();
        $table->string('gst_no')->nullable();
    });
    }
};
