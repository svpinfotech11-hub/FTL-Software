<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingEntry extends Model
{
    protected $fillable = [

        // LR Details
        'lr_no',
        'lr_date',
        'ref_lr_no',

        // Source
        'source_ledger_id',
        'source_address',
        'source_state',
        'source_city',
        'source_district',

        // Destination
        'destination_ledger_id',
        'destination_address',
        'destination_state',
        'destination_city',
        'destination_district',

        // Consignor Snapshot
        'consignor_ledger_name',
        'consignor_address1',
        'consignor_address2',
        'consignor_state',
        'consignor_city',
        'consignor_gstin',
        'consignor_phone',
        'consignor_mobile',

        // Consignee Snapshot
        'consignee_ledger_name',
        'consignee_address1',
        'consignee_address2',
        'consignee_state',
        'consignee_city',
        'consignee_gstin',
        'consignee_phone',
        'consignee_mobile',

        // Vehicle
        'vehicle_no',
        'owner_name',

        // Invoice
        'invoice_no',
        'invoice_date',
        'value_of_goods',
        'eway_bill_no',
        'ewb_exp_date',

        // Product
        'product_id',

        // Charges
        'freight',
        'hamali',
        'pre_bhadha',
        'bilty_charge',
        'colle_charges',
        'cpc',
        'other_charge',
        'total',

        // GST
        'cgst',
        'sgst',
        'igst',

        'advance',
        'grand_total',

        'lr_type',
        'apply_gst'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Source Ledger
    public function sourceLedger()
    {
        return $this->belongsTo(Ledger::class, 'source_ledger_id');
    }

    // Destination Ledger
    public function destinationLedger()
    {
        return $this->belongsTo(Ledger::class, 'destination_ledger_id');
    }
    // Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
