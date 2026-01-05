<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{

    Use SoftDeletes;
     protected $fillable = [
        'vendor_name',
        'contact',
        'address',
        'pincode',
        'state',
        'city',
        'rate_per_kg',
        'minimum_kg'
    ];
}
