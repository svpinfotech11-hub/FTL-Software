<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminUsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'admin')
            ->select('name', 'email', 'phone', 'status', 'created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status',
            'Created At',
        ];
    }
}
