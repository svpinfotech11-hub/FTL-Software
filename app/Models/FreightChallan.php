<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreightChallan extends Model
{
    protected $fillable = [
        'broker_id',
        'driver_id',
        'ledger_id',
        'challan_no',
        'challan_date',
        'licence_no',
        'payable_at',
        'lr_no',
        'vehicle_no',
        'actual_wt',
        'charged_wt',
        'freight_rate',
        'rate_type',
        'total_challan_amt',
        'loading',
        'load_remarks',
        'uld_amt',
        'uld_remarks',
        'detention',
        'det_remarks',
        'deduction',
        'ded_remarks',
        'detent_place',
        'border_exp',
        'border_remarks',
        'others',
        'other_remarks',
        'vehicle_type',
        'party_name',
        'supplier_name',
        'advance_type',
        'bank_name',
        'diesel_qty',
        'diesel_rate',
        'advance_amount',
        'remarks',
        'total_freight',
        'total_packing',
        'total_qty',
        'total_actual_wt',
        'total_charge_wt',
        'unloading',
        'borderexp',
        'others_amt',
        'grand_total',
        'advance_amt',
        'tds_percent',
        'tds_amt',
        'loading_amt',
        'detention_amt',
        'deduction_amt',
        'manual_amt',
        'net_advance_amt',
        'balance_amt',
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
