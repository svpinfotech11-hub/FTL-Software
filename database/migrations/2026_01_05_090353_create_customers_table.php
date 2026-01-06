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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('customer_code')->unique();
            $table->string('customer_name');
            $table->string('contact_person')->nullable();
            $table->string('phone', 15);
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('pincode', 6);
            $table->string('state');
            $table->string('city');
            $table->string('gst_no')->nullable();
            $table->boolean('gst_charges')->default(0);
            $table->integer('credit_days')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
