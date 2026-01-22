<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicle_hires', function (Blueprint $table) {
            if (!Schema::hasColumn('vehicle_hires', 'hire_register_id')) {
                $table->string('hire_register_id')->nullable()->after('id');
            }
        });

        // Generate hire register IDs for existing records
        $vehicleHires = DB::table('vehicle_hires')->orderBy('id')->get();
        $counter = 1;

        foreach ($vehicleHires as $hire) {
            if (empty($hire->hire_register_id)) {
                $hireRegisterId = 'HR' . str_pad($counter, 3, '0', STR_PAD_LEFT);
                DB::table('vehicle_hires')->where('id', $hire->id)->update(['hire_register_id' => $hireRegisterId]);
            }
            $counter++;
        }

        // Now make the column unique and not null
        Schema::table('vehicle_hires', function (Blueprint $table) {
            $table->string('hire_register_id')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_hires', function (Blueprint $table) {
            $table->dropColumn('hire_register_id');
        });
    }
};
