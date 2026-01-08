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
        Schema::create('add_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('branch_wise_invoice')->default(false);
            $table->string('company_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('stamp')->nullable();
            $table->string('tan_no')->nullable();
            $table->string('msme_no')->nullable();
            $table->string('iso_no')->nullable();
            $table->string('website')->nullable();
            $table->string('import_invoice_series')->nullable();
            $table->string('domestic_invoice_series')->nullable();
            $table->string('export_invoice_series')->nullable();
            $table->string('company_code')->nullable();
            $table->string('udyam_code')->nullable();
            $table->string('taxable_services')->nullable();
            $table->longText('invoice_terms')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->longText('bank_terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_companies');
    }
};
