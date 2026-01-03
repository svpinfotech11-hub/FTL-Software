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
        Schema::create('user_deletes', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('deleted_by');  // admin who deleted
            $table->unsignedBigInteger('user_id');     // user that was deleted
            $table->string('user_name');               // store name/email for reference
            $table->string('user_email');
            $table->timestamp('deleted_at');           // time of deletion

            // optional: foreign key to admins
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_deletes');
    }
};
