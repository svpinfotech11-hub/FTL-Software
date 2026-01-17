<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $casts = [
        'licence_exp' => 'date',
        'joining_date' => 'date',
        'leaving_date' => 'date',
        'dob' => 'date',
    ];

    protected $fillable = [
        'name',
        'father_name',
        'mother_name',
        'mobile',
        'mobile_alt',
        'address',
        'pincode',
        'state',
        'city',
        'licence_no',
        'licence_exp',
        'salary',
        'joining_date',
        'leaving_date',
        'dob',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['deleted_at'];
}
