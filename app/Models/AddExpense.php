<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddExpense extends Model
{
    protected $fillable = [
        'expense_date',
        'expense_type',
        'vehicle_no',
        'driver_id',
        'lr_no',
        'amount',
        'description',
        'attachment',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
