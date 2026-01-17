<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $casts = [
        'vehicle_puc_date' => 'date',
        'vehicle_fitness_exp_date' => 'date',
        'vehicle_permit_renewal_date' => 'date',
        'vehicle_insurance_renew_date' => 'date',
    ];

    protected $fillable = [
        'vehicle_number',
        'vehicle_registration',
        'vehicle_chesis',
        'vehicle_model',
        'vehicle_puc_date',
        'vehicle_fitness_exp_date',
        'vehicle_permit_renewal_date',
        'vehicle_insurance_renew_date',
        'vehicle_capacity',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $dates = ['deleted_at'];
}
