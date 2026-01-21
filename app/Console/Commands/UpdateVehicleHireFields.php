<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateVehicleHireFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-vehicle-hire-fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update vehicle hire records to populate vendor_name, vehicle_no, and driver_details from related tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating vehicle hire vendor names...');
        DB::update('UPDATE vehicle_hires vh LEFT JOIN vendors v ON vh.vendor_id = v.id SET vh.vendor_name = v.vendor_name WHERE vh.vendor_id IS NOT NULL AND (vh.vendor_name IS NULL OR vh.vendor_name = "")');

        $this->info('Updating vehicle hire vehicle numbers...');
        DB::update('UPDATE vehicle_hires vh LEFT JOIN vehicles v ON vh.vehicle_id = v.id SET vh.vehicle_no = v.vehicle_number WHERE vh.vehicle_id IS NOT NULL AND (vh.vehicle_no IS NULL OR vh.vehicle_no = "")');

        $this->info('Updating vehicle hire driver details...');
        DB::update('UPDATE vehicle_hires vh LEFT JOIN drivers d ON vh.driver_id = d.id SET vh.driver_details = CONCAT(d.name, " (", d.contact_no, ")") WHERE vh.driver_id IS NOT NULL AND (vh.driver_details IS NULL OR vh.driver_details = "")');

        $this->info('Vehicle hire fields updated successfully!');
    }
}
