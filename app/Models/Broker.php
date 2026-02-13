<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $fillable = [
        'ledger_group',
        'broker_name',
        'address1',
        'address2',
        'state',
        'city',
        'gst_no',
        'phone_no',
        'mobile_no'
    ];
}
