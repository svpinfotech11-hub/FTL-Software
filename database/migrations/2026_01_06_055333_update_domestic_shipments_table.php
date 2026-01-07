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
    $table->foreignId('consigner_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('consignee_id')->nullable()->constrained()->nullOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
