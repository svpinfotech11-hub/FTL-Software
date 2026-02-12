<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      protected $table = 'products';

    // Mass assignable fields
    protected $fillable = [
        'product_name',
        'description',
        'qty',
        'actual_wt',
        'charge_wt',
        'unit_bag_rate',
        'rate_type',
        'rec_weight',
        'shortage_wt',
        'shortage_rate',
        'shortage_amt',
        'amount',
        'length',
        'width',
        'height',
    ];

    // Casts for automatic type conversion
    protected $casts = [
        'qty' => 'integer',
        'actual_wt' => 'float',
        'charge_wt' => 'float',
        'unit_bag_rate' => 'float',
        'rec_weight' => 'float',
        'shortage_wt' => 'float',
        'shortage_rate' => 'float',
        'shortage_amt' => 'float',
        'amount' => 'float',
        'length' => 'float',
        'width' => 'float',
        'height' => 'float',
    ];
}
