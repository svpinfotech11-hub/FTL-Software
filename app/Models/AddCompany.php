<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddCompany extends Model
{
    protected $fillable = [
        'user_id',
        'branch_wise_invoice',
        'company_name',
        'logo',
        'stamp',
        'tan_no',
        'msme_no',
        'iso_no',
        'website',
        'import_invoice_series',
        'domestic_invoice_series',
        'export_invoice_series',
        'company_code',
        'udyam_code',
        'taxable_services',
        'invoice_terms',
        'account_name',
        'account_number',
        'ifsc',
        'bank_name',
        'branch_name',
        'bank_terms',
    ];

    protected $casts = [
        'branch_wise_invoice' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
