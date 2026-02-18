<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GstBilling extends Model
{
    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'consignor_id',
        'consignee_id',
        'product_id',
        'po_no',
        'vehicle_no',
        'supply_place',
        'supply_date',
        'trans_mode',
        'reverse_charge',
        'description',
        'uom',
        'hsn_code',
        'qty',
        'rate',
        'total',
        'disc_percent',
        'taxable_value',
        'gst_percent',
        'cgst_amt',
        'sgst_amt',
        'igst_amt',
        'total_amt',
        'disc_amt',
        'total_tax_amt',
        'tot_cgst_amt',
        'tot_sgst_amt',
        'tot_igst_amt',
        'freight',
        'others',
        'tcs_percent',
        'tcs_amt',
        'grand_total',
        'advance',
        'net_amt',
        'narration'
    ];

    public function consigner()
    {
        return $this->belongsTo(consigner::class, 'consignor_id');
    }

    public function consignee()
    {
        return $this->belongsTo(Consignee::class, 'consignee_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
