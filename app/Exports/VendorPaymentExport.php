<?php

namespace App\Exports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VendorPaymentExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $userId = auth()->id();

        return Vendor::with(['vehicleHires' => function ($q) use ($userId) {
            $q->where('user_id', $userId);
        }])->get();
    }

    public function map($vendor): array
    {
        $totalHires = $vendor->vehicleHires->count();
        $totalHireAmount = $vendor->vehicleHires->sum('hire_rate');
        $totalAdvancePaid = $vendor->vehicleHires->sum('advance_paid');
        $totalBalance = $vendor->vehicleHires->sum('balance_payable');

        $paid = $partial = $pending = 0;

        foreach ($vendor->vehicleHires as $hire) {
            if ($hire->balance_payable <= 0 || $hire->advance_paid >= $hire->hire_rate) {
                $paid++;
            } elseif ($hire->advance_paid > 0) {
                $partial++;
            } else {
                $pending++;
            }
        }

        return [
            $vendor->vendor_name,
            $totalHires,
            $totalHireAmount,
            $totalAdvancePaid,
            $totalBalance,
            $paid,
            $partial,
            $pending
        ];
    }

    public function headings(): array
    {
        return [
            'Vendor',
            'Total Hires',
            'Total Hire Amount',
            'Total Advance Paid',
            'Total Balance',
            'Fully Paid Hires',
            'Partially Paid Hires',
            'Pending Hires'
        ];
    }
}
