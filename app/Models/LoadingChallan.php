<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoadingChallan extends Model
{
    protected $fillable = [
        'challan_no',
        'challan_date',
        'vehicle_no',
        'vehicle_owner',
        'source',
        'source_state',
        'source_city',
        'source_district',
        'destination',
        'destination_state',
        'destination_city',
        'destination_district',
        'broker_id',
        'driver_id',
        'total_freight',
        'truck_freight',
        'advance',
        'commission_amount',
        'lc_charge',
        'dc_charge',
        'cf_charge',
        'net_amount',
        'remarks',
        'firm_branch',
        'license_no',
        'challan_type',
        'lr_no',
        'gr_no',
        'tot_crossing'
    ];

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
