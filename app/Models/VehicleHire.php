<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleHire extends Model
{
    protected $fillable = [
        'user_id',
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
}
