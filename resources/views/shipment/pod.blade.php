<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GR / Lorry Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            background-color: #f5f5f5;
            margin: 20px;
        }

        .container {
            width: 50%;
            /* keep half-page width */
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            float: left;
            /* align to left side */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .small {
            font-size: 11px;
        }

        .no-border {
            border: none;
        }

        .height-30 {
            height: 30px;
        }

        .height-40 {
            height: 40px;
        }

        .height-60 {
            height: 60px;
        }
    </style>
</head>

<body>
    <div class="container">
     <table width="100%" border="1" cellspacing="0" cellpadding="6" style="border-collapse:collapse;font-size:12px;">

      <tr>
        <td colspan="2" align="center">
            @if($company && $company->logo)
                <img src="{{ asset('uploads/company/logo/'.$company->logo) }}"
                     style="max-height:70px;">
            @endif
        </td>

        <td colspan="7" align="center">
            <h3 style="margin:0;color:red; font-size:20px">{{ $company->company_name }}</h3>
            <strong style="font-size: 20px;">TRANSPORTATION & LOGISTICS SOLUTIONS</strong><br>
            {{ $company->website ?? '' }}
        </td>

        <td colspan="3" align="center" class="bold">
            Consignor Copy
        </td>
    </tr>
    {{-- ================= HEADER TOP ================= --}}
    <tr>
        <td colspan="4" class="bold">
            GSTIN: {{ $company->gstin ?? '-' }}
        </td>
        <td colspan="4" align="center" class="bold">
            GR No.: {{ $shipment->gr_no ?? '-' }}
        </td>
        <td colspan="4" align="right" class="bold">
            PAN NO: {{ $company->pan_no ?? '-' }}
        </td>
    </tr>

    <tr>
        <td colspan="2" class="bold">AT OWNER'S RISK</td>
        <td colspan="2" class="bold">MODVAT COPY</td>
        <td colspan="2" class="bold">{{ $shipment->booking_mode ?? 'BOOKING MODE' }}</td>
        <td colspan="2" class="bold">
            DATE: {{ optional($shipment->created_at)->format('d-m-Y') }}
        </td>
        <td colspan="2" class="bold">RATE</td>
        <td colspan="2" class="bold">FREIGHT DETAILS</td>
    </tr>

    <tr>
        <td colspan="12" align="center" class="small bold">
            Subject to {{ $company->jurisdiction ?? 'Bhiwandi' }} Jurisdiction only
        </td>
    </tr>

    {{-- ================= COMPANY HEADER ================= --}}

    {{-- ================= CONSIGNOR / CONSIGNEE ================= --}}
    <tr>
        <td colspan="6" class="bold">CONSIGNOR</td>
        <td colspan="6" class="bold">CONSIGNEE</td>
    </tr>

    <tr style="height:70px;">
        <td colspan="6">
            {{ $shipment->consignor_name ?? '' }}<br>
            {{ $shipment->consignor_address ?? '' }}
        </td>
        <td colspan="6">
            {{ $shipment->consignee_name ?? '' }}<br>
            {{ $shipment->consignee_address ?? '' }}
        </td>
    </tr>

    <tr>
        <td colspan="3">GST No: {{ $shipment->consignor_gst ?? '-' }}</td>
        <td colspan="3">Phone: {{ $shipment->consignor_phone ?? '-' }}</td>
        <td colspan="3">GST No: {{ $shipment->consignee_gst ?? '-' }}</td>
        <td colspan="3">Phone: {{ $shipment->consignee_phone ?? '-' }}</td>
    </tr>

    <tr>
        <td colspan="6"><b>FROM:</b> {{ $shipment->from_location ?? '' }}</td>
        <td colspan="6"><b>TO:</b> {{ $shipment->to_location ?? '' }}</td>
    </tr>

    {{-- ================= CONSIGNMENT DETAILS ================= --}}
    <tr>
        <td colspan="6" class="bold">CONSIGNMENT DETAILS</td>
        <td colspan="6" class="bold">PAYMENT TERMS</td>
    </tr>

    <tr align="center">
        <td>No. of Pkgs</td>
        <td>Packing</td>
        <td colspan="2">Item Description</td>
        <td colspan="2">Freight Mode</td>
        <td colspan="3">Billing Station</td>
        <td colspan="3" class="bold">FREIGHT DETAILS</td>
    </tr>

    <tr>
        <td>{{ $shipment->no_of_packages ?? '' }}</td>
        <td>{{ $shipment->packing_type ?? '' }}</td>
        <td colspan="2">{{ $shipment->item_description ?? '' }}</td>
        <td colspan="2">{{ $shipment->freight_mode ?? '' }}</td>
        <td colspan="3">{{ $shipment->billing_station ?? '' }}</td>
        <td>Rate</td>
        <td>{{ $shipment->rate ?? '' }}</td>
        <td></td>
    </tr>

    {{-- ================= WEIGHT & SEAL ================= --}}
    <tr>
        <td class="bold">TOTAL CFT</td>
        <td>Per CFT</td>
        <td>Actual Weight</td>
        <td>Charged Weight</td>
        <td colspan="5" align="center">
            @if($company && $company->stamp)
                <img src="{{ asset('uploads/company/stamp/'.$company->stamp) }}"
                     style="max-height:60px;"><br>
            @endif
            Seal of the Company
        </td>
        <td>Detention</td>
        <td></td>
        <td></td>
    </tr>

    {{-- ================= TOTAL ================= --}}
    <tr>
        <td colspan="9"></td>
        <td class="bold">G. TOTAL</td>
        <td>{{ $shipment->grand_total ?? '' }}</td>
        <td></td>
    </tr>

    {{-- ================= FOOTER ================= --}}
    <tr>
        <td colspan="3" class="bold">QUALITY & QUANTITY NOT CHECKED</td>
        <td colspan="3" class="bold">REMARKS</td>
        <td colspan="3" class="bold">ENDORSEMENT</td>
        <td colspan="3" class="bold center">
            GENERAL INFORMATION<br>
            {{ $company->company_name }}
        </td>
    </tr>

    <tr>
        <td colspan="3">Signature of Consignor</td>
        <td colspan="3">Unloading by Consignee</td>
        <td colspan="3">Bank Use (If Any)</td>
        <td colspan="3">
            This is not a GST Invoice<br>
            For Tax Invoice contact branch
        </td>
    </tr>

</table>


</body>

</html>