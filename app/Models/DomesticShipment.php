<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DomesticShipment extends Model
{
    protected $table = 'domestic_shipments';

    // protected $fillable = [
    //     'shipment_date',
    //     'courier',
    //     'airway_no',
    //     'risk_type',
    //     'bill_type',
    //     'vehicle_no',
    //     'description',

    //     'consigner_name',
    //     'consigner_address',
    //     'consigner_pincode',
    //     'consigner_state',
    //     'consigner_city',
    //     'consigner_contact',
    //     'consigner_save_to_address_book',
    //     'consigner_type_of_doc',
    //     'coll_type',
    //     'delivery_type',

    //     'consignee_name',
    //     'consignee_company',
    //     'consignee_address',
    //     'consignee_pincode',
    //     'consignee_state',
    //     'consignee_city',
    //     'consignee_contact',
    //     'consignee_save_to_address_book',
    //     'consignee_type_of_doc',

    //     'zone',
    //     'gst_no',
    //     'tax',

    //     'pkt',
    //     'qty',
    //     'actual_weight',
    //     'chargeable_weight',

    //     'freight',
    //     'door_collection',
    //     'insurance',
    //     'awb_charge',
    //     'hamali',
    //     'godown_collection',
    //     'eway_charge',
    //     'fuel_surcharge',

    //     'handling_charge',
    //     'door_delivery',
    //     'cod',
    //     'other_charge',
    //     'appt_charge',
    //     'godown_delivery',
    //     'fov_charge',

    //     'sub_total',
    //     'cgst',
    //     'sgst',
    //     'igst',
    //     'grand_total',

    //     'user_id',

    //     'customer_id',
    //     'consigner_id',
    //     'consignee_id',
    // ];


    protected $fillable = [
        'user_id',
        'customer_id',
        'consigner_id',
        'consignee_id',
        'shipment_date',
        'courier',
        'airway_no',
        'risk_type',
        'bill_type',
        'vehicle_no',
        'description',
        'pkt',
        'qty',
        'actual_weight',
        'chargeable_weight',
        'sub_total',
        'tax_type',
        'tax',
        'cgst',
        'sgst',
        'igst',
        'grand_total',
        'vehicle_type',
        'vehicle_number',
        'driver_name',
        'driver_number',
        'vehicle_hire_id',
        'mode',
        'rate'
    ];

    protected $casts = [
        'shipment_date' => 'date',
    ];
    public function invoices()
    {
        return $this->hasMany(ShipmentInvoice::class, 'domestic_shipment_id');
    }

    public function consigner()
    {
        return $this->belongsTo(Consigner::class);
    }

    public function consignee()
    {
        return $this->belongsTo(Consignee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicleHire()
    {
        return $this->belongsTo(VehicleHire::class);
    }

    public function company()
    {
        return $this->belongsTo(AddCompany::class, 'company_id');
    }

    protected $dates = ['deleted_at'];
}
