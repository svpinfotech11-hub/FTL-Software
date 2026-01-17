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
        Schema::create('consignees', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('company')->nullable();
            $table->text('address')->nullable();
            $table->string('pincode', 10);
            $table->string('state');
            $table->string('city');
            $table->string('zone')->nullable();
            $table->string('contact_no', 15)->nullable();
            $table->string('gst_no')->nullable();

            $table->boolean('is_saved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignees');
    }
};
