<?php

namespace App\Exports;

use App\Models\DomesticShipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DomesticShipmentReportExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = DomesticShipment::with(['consigner', 'consignee', 'vehicleHire'])
            ->where('user_id', auth()->id());

        if ($this->request->customer_id) {
            $query->where('customer_id', $this->request->customer_id);
        }

        if ($this->request->consigner_id) {
            $query->where('consigner_id', $this->request->consigner_id);
        }

        if ($this->request->consignee_id) {
            $query->where('consignee_id', $this->request->consignee_id);
        }

        if ($this->request->start_date && $this->request->end_date) {
            $query->whereBetween('shipment_date', [
                $this->request->start_date,
                $this->request->end_date
            ]);
        }

        return $query->latest()->get()->map(function ($row) {

            $purchaseCost = 0;
            if ($row->vehicle_type === 'rented' && $row->vehicleHire) {
                $purchaseCost = $row->vehicleHire->hire_rate;
            }

            return [
                'Date'          => optional($row->shipment_date)->format('d-m-Y'),
                'Airway No'     => $row->airway_no,
                'Consigner'     => $row->consigner?->name,
                'Consignee'     => $row->consignee?->name,
                'Destination'   => $row->consignee?->city,
                'Vehicle Type'  => ucfirst($row->vehicle_type),
                'Hire Register' => $row->vehicleHire?->hire_register_id ?? 'OWN',
                'Hire Rate'     => $row->vehicleHire?->hire_rate ?? 0,
                'Grand Total'   => $row->grand_total,
                'Total Cost'    => $purchaseCost,
                'Profit/Loss'   => $row->grand_total - $purchaseCost,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Airway No',
            'Consigner',
            'Consignee',
            'Destination',
            'Vehicle Type',
            'Hire Register',
            'Hire Rate',
            'Grand Total',
            'Total Cost',
            'Profit/Loss',
        ];
    }
}
