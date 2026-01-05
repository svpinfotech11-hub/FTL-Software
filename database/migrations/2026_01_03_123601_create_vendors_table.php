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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('contact');
            $table->text('address');
            $table->string('pincode', 10);
            $table->string('state');
            $table->string('city');
            $table->decimal('rate_per_kg', 8, 2);
            $table->decimal('minimum_kg', 8, 2);
            $table->softDeletes(); // adds deleted_at

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
