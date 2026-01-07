<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consigner extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'name',
        'address',
        'pincode',
        'state',
        'city',
        'contact_no',
        'type_of_doc',
        'gst_no',
        'is_saved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

      protected $dates = ['deleted_at'];
}
