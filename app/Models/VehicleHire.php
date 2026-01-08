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
        'driver_details',
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
}
