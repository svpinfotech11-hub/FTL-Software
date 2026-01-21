<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleHire extends Model
{
    protected $fillable = [
        'user_id',
        'hire_register_id',
        'hire_date',
        'vendor_name',
        'vehicle_no',
        'driver_id',
        'vendor_id',
        'vehicle_id',
        'route_from',
        'route_to',
        'lr_manifest_no',
        'hire_rate',
        'advance_paid',
        'balance_payable',
        'payment_status',
        'rc_document',
        'insurance_document',
        'pan_document',
        'other_document',
    ];

     public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Accessors to get data from relationships if stored fields are null
    public function getVendorNameAttribute($value)
    {
        return $value ?: optional($this->vendor)->vendor_name;
    }

    public function getVehicleNoAttribute($value)
    {
        return $value ?: optional($this->vehicle)->vehicle_number;
    }

    public function getDriverDetailsAttribute($value)
    {
        if ($value) {
            return $value;
        }
        $driver = $this->driver;
        return $driver ? $driver->name . ' (' . $driver->contact_no . ')' : null;
    }
}
