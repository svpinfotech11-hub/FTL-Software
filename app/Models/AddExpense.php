<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddExpense extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel naming conventions)
    protected $table = 'add_expenses';

    protected $casts = [
        'expense_type' => 'array',
        'attachment' => 'array',
    ];

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'vehicle_hire_id',
        'driver_id',
        'vehicle_id',
        'vendor_id',
        'user_id',
        'expense_date',
        'amount',
        'paid_by',
        'lr_no',
        'description',
        'expense_type',
        'attachment',
    ];

    /**
     * Relationships
     */

    // Expense belongs to a vehicle hire
    public function vehicleHire()
    {
        return $this->belongsTo(VehicleHire::class);
    }

    // Expense may belong to a driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // Expense may belong to a vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Expense may belong to a vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    // Expense belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
