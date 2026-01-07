<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
     protected $fillable = [
        'user_id',
        'name',
        'company',
        'address',
        'pincode',
        'state',
        'city',
        'zone',
        'contact_no',
        'gst_no',
        'is_saved'
    ];

      protected $dates = ['deleted_at'];
}
