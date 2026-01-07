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
        'user_id'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $dates = ['deleted_at'];
}
