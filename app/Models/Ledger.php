<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $fillable = [
        'ledger_group',
        'gst_no',
        'party_name',
        'party_alias',
        'address1',
        'address2',
        'state_name',
        'city_name',
        'pan_no',
        'iec_no',
        'aadhar_no',
        'rc_no',
        'license_no',
        'phone_no',
        'mobile_no',
        'email',
        'opening_bal',
        'opening_type',
        'arn_no',
        'exim_code',
        'pan_upload',
        'declaration_upload',
        'aadhar_upload',
        'gst_upload',
        'office_photo',
        'bank_name',
        'account_no',
        'branch_name',
        'ifsc_code',
    ];
}
