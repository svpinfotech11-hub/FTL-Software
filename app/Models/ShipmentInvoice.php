<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentInvoice extends Model
{
    protected $fillable = [
        'domestic_shipment_id',
        'invoice_no',
        'invoice_value',
        'invoice_date',
        'quantity',
        'type_of_parcel',
        'eway_no',
        'eway_expiry'
    ];

    public function shipment()
    {
        return $this->belongsTo(DomesticShipment::class);
    }
}
