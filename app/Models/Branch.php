<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'branch_name',
        'branch_code',
        'email',
        'contact_no',
        'contact_person',
        'address',
        'city',
        'state',
        'pincode',
        'gst_number',
        'pan',
        'account_name',
        'account_number',
        'account_bank_name',
        'ifsc',
        'warehouse_branch_name',
        'export_invoice_series',
        'import_invoice_series',
        'domestic_invoice_series',
        'domestic_booking_series',
        'domestic_pod_series'
    ];
}
