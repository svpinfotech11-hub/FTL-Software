<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    'user_id',
    'customer_code',
    'customer_name',
    'contact_person',
    'phone',
    'email',
    'address',
    'pincode',
    'state',
    'city',
    'gst_no',
    'gst_charges',
    'credit_days',
];

}
