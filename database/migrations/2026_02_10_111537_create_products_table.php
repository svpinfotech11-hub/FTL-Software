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
         Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->integer('qty');
            $table->decimal('actual_wt', 10, 2)->nullable();
            $table->decimal('charge_wt', 10, 2)->nullable();
            $table->decimal('unit_bag_rate', 10, 2)->nullable();
            $table->string('rate_type')->nullable();
            $table->decimal('rec_weight', 10, 2)->nullable();
            $table->decimal('shortage_wt', 10, 2)->nullable();
            $table->decimal('shortage_rate', 10, 2)->nullable();
            $table->decimal('shortage_amt', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('length', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
