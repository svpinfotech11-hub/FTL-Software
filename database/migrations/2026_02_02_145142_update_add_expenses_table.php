<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('add_expenses', function (Blueprint $table) {
            $table->json('expense_type')->nullable()->change();
            $table->json('attachment')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('add_expenses', function (Blueprint $table) {
            $table->string('expense_type')->change();
            $table->string('attachment')->nullable()->change();
        });
    }
};
