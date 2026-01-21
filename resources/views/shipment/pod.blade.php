<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
    <style>
        input[type=text] {}

        Body {
            font-family: Arial;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            /* Example: 1px solid black border */
        }

        table {
            border-collapse: collapse;
        }
    </style>
    <style>
        .no-border td {
            border: none;
            vertical-align: middle;
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
            font-size: 14px;
            color: #1f3556;
            font-weight: 600;
        }

        .heading {
            font-size: 40px;
            font-weight: bold;
            color: #e60000;
            font-family: "Times New Roman", serif;
            letter-spacing: 1px;
            margin: 5px 0;
        }

        .subheading {
            background: #2e4a72;
            color: #fff;
            display: inline-block;
            padding: 6px 18px;
            font-size: 16px;
            font-weight: bold;
            margin: 6px 0;
        }

        .address {
            font-size: 18px;
            font-weight: 700;
            color: #2e4a72;
        }

        .copy-box {
            border: 1.5px solid red;
            color: red;
            padding: 6px 12px;
            font-weight: bold;
            font-size: 18px;
            display: inline-block;
            margin-top: 10px;
        }

        .header-table td {
            border: none !important;
        }
    </style>
</head>

<body>
    <table width="1000" border="0">
        <tr>

            <!-- LOGO -->
            <td width="20%" align="left" class="header-table" style="border:none">
                @if($company && $company->logo)
                <img src="{{ asset('uploads/company/logo/'.$company->logo) }}" style="max-width:170px;">
                @endif
            </td>

            <!-- CENTER CONTENT -->
            <td width="60%" class="center header-table" style="padding:10px 15px; border: none !important;">

                <div class="small">
                    <!-- Subject to {{ $company->jurisdiction ?? 'Bhiwandi' }} Jurisdiction only -->
                </div>

                <div class="heading">
                    {{ $company->company_name ?? 'SHREE LOGISTICS SOLUTIONS' }}
                </div>

                <!-- <div class="subheading">
        TRANSPORTATION & LOGISTICS SOLUTIONS
    </div> -->

                <div class="address">
                    {{ Auth::user()->address }}
                </div>

                <div class="address">
                    Dist-{{ Auth::user()->city }} &nbsp;&nbsp;&nbsp;
                    Website: {{ $company->website ?? '' }}
                </div>

            </td>

            <!-- RIGHT SIDE -->
            <td width="20%" class="right header-table" style="padding:10px 15px; border: none !important;">

                <div class="small bold" style="margin-bottom:10px;">
                    Mob. {{ Auth::user()->phone }}
                </div>

                <div class="copy-box">
                    Consignor Copy
                </div>

            </td>


        </tr>
    </table>

    <!-- end header -->


    <table width="1000" border="0">
        <tr>
            <td width="438"><strong>&nbsp;
                    </th>

                    GSTIN: {{ Auth::user()->gst }}
                </strong>
            <td width="193" align="center"><strong>GR No. {{ $shipment->id }}</strong></td>
            <td width="349" align="right"><strong>PAN NO: {{ Auth::user()->pan }}</strong></td>
        </tr>
    </table>

    <table width="998" border="0">
        <tr>
            <td colspan="2"><strong>AT OWNER&quot;S RISK</strong></td>
            <td colspan="2"><strong>MODVAT COPY</strong></td>
            <td colspan="2"><strong>BOOKING MODE</strong></td>
            <td colspan="2"><strong>DATE</strong></td>
            <td colspan="2"><strong>RATE</strong></td>
            <td colspan="2"><strong>FRIGHT DETAILS</strong></td>
        </tr>
        <tr>
            <td colspan="2" align="left" scope="row" style="font-size:9px">{{ $shipment->risk_type ?? 'AT OWNER"S RISK' }}</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">{{ $shipment->shipment_date ? \Carbon\Carbon::parse($shipment->shipment_date)->format('d-m-Y') : '' }}</td>
            <td colspan="2">{{ $shipment->created_at ? $shipment->created_at->format('d-m-Y') : '' }}</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" align="left" scope="row"><strong>Consignor</strong></th>
            <td colspan="4"><strong>Consignee</strong></td>
            <td colspan="2"><strong>FRIGHT DETAILS</strong></td>
            <td width="65"><strong>Rs.</strong></td>
            <td width="51"><strong>P.</strong></td>
        </tr>
        <tr>
            <th colspan="4" scope="row">&nbsp;</th>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">Rate</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" scope="row">&nbsp;</th>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">Freight</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th width="90" align="left" scope="row">GST NO.</th>
            <td colspan="3">{{ $shipment->consigner->gst_no ?? '' }}</td>
            <td width="149"><strong>GST NO.</strong></td>
            <td colspan="3">{{ $shipment->consignee->gst_no ?? '' }}</td>
            <td colspan="2">S.T. Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" scope="row">Phone No.</th>
            <td colspan="3">{{ $shipment->consigner->contact_no ?? '' }}</td>
            <td><strong>Phone No.</strong></td>
            <td colspan="3">{{ $shipment->consignee->contact_no ?? '' }}</td>
            <td colspan="2">Surcharge</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" scope="row">FROM:</th>
            <td colspan="3">{{ $shipment->consigner->city ?? '' }}</td>
            <td><strong>TO:</strong></td>
            <td colspan="3">{{ $shipment->consignee->city ?? '' }}</td>
            <td colspan="2">Hamali(Booking)</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="left" scope="row">CONSIGNMENT DETAILS</td>
            <td colspan="4">PAYMENT TERMS</td>
            <td colspan="2">F.O.V</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">No. of Pkgs</td>
            <td width="77">Type of Packing</td>
            <td colspan="2">Item Description</td>
            <td colspan="2">Freight Mode</td>
            <td colspan="2">Billing Station</td>
            <td colspan="2">Collection Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" scope="row">In Figures</td>
            <td rowspan="3">&nbsp;</td>
            <td colspan="2" rowspan="3">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">Delivery Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2" scope="row">&nbsp;</th>
            <td colspan="4" rowspan="3" align="left" valign="top">If paid by Cash/Cheque, Specify amount<br />
                (in Figures)Rs.</td>
            <td colspan="2">Detention Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Logistic Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" scope="row">In Words</td>
            <td colspan="3">Invoice No (s)</td>
            <td colspan="2">Dernurrage Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Date</td>
            <td colspan="4"><strong>E-Way Bill No.</strong></td>
            <td colspan="2">Hamali(Delivery)</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Gross Invoice Value</td>
            <td colspan="4"><strong>E-Way Bill Date:</strong></td>
            <td colspan="2">Others</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Net Voice Value</td>
            <td colspan="4" rowspan="2" valign="top">Consignment Acknowledgement by Consignee<br />
                Received the shipment as per details contained here in</td>
            <td width="60">&nbsp;</td>
            <td width="54"><strong>TOTAL</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">Comension inches</td>
            <td colspan="3">Part (s)</td>
            <td>&nbsp;</td>
            <td>CGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Quantity</td>
            <td colspan="4">Signature:</td>
            <td>&nbsp;</td>
            <td>SGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">TOTALCFT</td>
            <td>Per CFT(Kgs)</td>
            <td width="68">Actual CFT(Kgs)</td>
            <td width="60">Charged Weight (Kgs)</td>
            <td colspan="4">Seal of the Compnay with date</td>
            <td>&nbsp;</td>
            <td>IGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2" scope="row">&nbsp;</th>
            <td rowspan="2">&nbsp;</td>
            <td rowspan="2">&nbsp;</td>
            <td rowspan="2">&nbsp;</td>
            <td colspan="4" rowspan="2">&nbsp;</td>
            <td>&nbsp;</td>
            <td>G.TOTAL</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="center"><strong>Transport ID: 27AFOFSO431C1Z7</strong></td>
        </tr>
        <tr>
            <td colspan="2" scope="row">QUALITY & QUANTITY NOT CHECKED</td>
            <td colspan="2">REMARKS</td>
            <td colspan="3">ENSORSEMENT</td>
            <td colspan="3">GENERAL INFORMATION</td>
            <td colspan="2" style="font-size:10px;">SHREE LOGISTICS SOLUTIONS</td>
        </tr>
        <tr>
            <td colspan="2" scope="row">Signature of the Consignor of his agent</td>
            <td colspan="2">Unloding by Consignee</td>
            <td colspan="3">If is Intended to use the CONSIGNEE Copy of this set forthe purpose of borrowing from the Consignee bank</td>
            <td colspan="3">This is not a GST Invoice For <br />
                Tax Invoice Contact to our branch</td>
            <td colspan="2"><span style="font-size:10px;">Employee Name</span></td>
        </tr>
    </table>

    <p>&nbsp;</p>

   <table width="1000" border="0">
        <tr>

            <!-- LOGO -->
            <td width="20%" align="left" class="header-table" style="border:none">
                @if($company && $company->logo)
                <img src="{{ asset('uploads/company/logo/'.$company->logo) }}" style="max-width:170px;">
                @endif
            </td>

            <!-- CENTER CONTENT -->
            <td width="60%" class="center header-table" style="padding:10px 15px; border: none !important;">

                <div class="small">
                    <!-- Subject to {{ $company->jurisdiction ?? 'Bhiwandi' }} Jurisdiction only -->
                </div>

                <div class="heading">
                    {{ $company->company_name ?? 'SHREE LOGISTICS SOLUTIONS' }}
                </div>

                <!-- <div class="subheading">
        TRANSPORTATION & LOGISTICS SOLUTIONS
    </div> -->

                <div class="address">
                    {{ Auth::user()->address }}
                </div>

                <div class="address">
                    Dist-{{ Auth::user()->city }} &nbsp;&nbsp;&nbsp;
                    Website: {{ $company->website ?? '' }}
                </div>

            </td>

            <!-- RIGHT SIDE -->
            <td width="20%" class="right header-table" style="padding:10px 15px; border: none !important;">

                <div class="small bold" style="margin-bottom:10px;">
                    Mob. {{ Auth::user()->phone }}
                </div>

                <div class="copy-box">
                    Consignor Copy
                </div>

            </td>


        </tr>
    </table>

    <!-- end header -->


    <table width="1000" border="0">
        <tr>
            <td width="438"><strong>&nbsp;
                    </th>

                    GSTIN: {{ Auth::user()->gst }}
                </strong>
            <td width="193" align="center"><strong>GR No. {{ $shipment->id }}</strong></td>
            <td width="349" align="right"><strong>PAN NO: {{ Auth::user()->pan }}</strong></td>
        </tr>
    </table>

    <table width="998" border="0">
        <tr>
            <td colspan="2"><strong>AT OWNER&quot;S RISK</strong></td>
            <td colspan="2"><strong>MODVAT COPY</strong></td>
            <td colspan="2"><strong>BOOKING MODE</strong></td>
            <td colspan="2"><strong>DATE</strong></td>
            <td colspan="2"><strong>RATE</strong></td>
            <td colspan="2"><strong>FRIGHT DETAILS</strong></td>
        </tr>
        <tr>
            <td colspan="2" align="left" scope="row" style="font-size:9px">{{ $shipment->risk_type ?? 'AT OWNER"S RISK' }}</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">{{ $shipment->shipment_date ? \Carbon\Carbon::parse($shipment->shipment_date)->format('d-m-Y') : '' }}</td>
            <td colspan="2">{{ $shipment->created_at ? $shipment->created_at->format('d-m-Y') : '' }}</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" align="left" scope="row"><strong>Consignor</strong></th>
            <td colspan="4"><strong>Consignee</strong></td>
            <td colspan="2"><strong>FRIGHT DETAILS</strong></td>
            <td width="65"><strong>Rs.</strong></td>
            <td width="51"><strong>P.</strong></td>
        </tr>
        <tr>
            <th colspan="4" scope="row">&nbsp;</th>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">Rate</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th colspan="4" scope="row">&nbsp;</th>
            <td colspan="4">&nbsp;</td>
            <td colspan="2">Freight</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th width="90" align="left" scope="row">GST NO.</th>
            <td colspan="3">{{ $shipment->consigner->gst_no ?? '' }}</td>
            <td width="149"><strong>GST NO.</strong></td>
            <td colspan="3">{{ $shipment->consignee->gst_no ?? '' }}</td>
            <td colspan="2">S.T. Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" scope="row">Phone No.</th>
            <td colspan="3">{{ $shipment->consigner->contact_no ?? '' }}</td>
            <td><strong>Phone No.</strong></td>
            <td colspan="3">{{ $shipment->consignee->contact_no ?? '' }}</td>
            <td colspan="2">Surcharge</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" scope="row">FROM:</th>
            <td colspan="3">{{ $shipment->consigner->city ?? '' }}</td>
            <td><strong>TO:</strong></td>
            <td colspan="3">{{ $shipment->consignee->city ?? '' }}</td>
            <td colspan="2">Hamali(Booking)</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="left" scope="row">CONSIGNMENT DETAILS</td>
            <td colspan="4">PAYMENT TERMS</td>
            <td colspan="2">F.O.V</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">No. of Pkgs</td>
            <td width="77">Type of Packing</td>
            <td colspan="2">Item Description</td>
            <td colspan="2">Freight Mode</td>
            <td colspan="2">Billing Station</td>
            <td colspan="2">Collection Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" scope="row">In Figures</td>
            <td rowspan="3">&nbsp;</td>
            <td colspan="2" rowspan="3">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2">Delivery Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2" scope="row">&nbsp;</th>
            <td colspan="4" rowspan="3" align="left" valign="top">If paid by Cash/Cheque, Specify amount<br />
                (in Figures)Rs.</td>
            <td colspan="2">Detention Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">Logistic Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left" scope="row">In Words</td>
            <td colspan="3">Invoice No (s)</td>
            <td colspan="2">Dernurrage Charges</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Date</td>
            <td colspan="4"><strong>E-Way Bill No.</strong></td>
            <td colspan="2">Hamali(Delivery)</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Gross Invoice Value</td>
            <td colspan="4"><strong>E-Way Bill Date:</strong></td>
            <td colspan="2">Others</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Net Voice Value</td>
            <td colspan="4" rowspan="2" valign="top">Consignment Acknowledgement by Consignee<br />
                Received the shipment as per details contained here in</td>
            <td width="60">&nbsp;</td>
            <td width="54"><strong>TOTAL</strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">Comension inches</td>
            <td colspan="3">Part (s)</td>
            <td>&nbsp;</td>
            <td>CGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th scope="row">&nbsp;</th>
            <td colspan="3">Quantity</td>
            <td colspan="4">Signature:</td>
            <td>&nbsp;</td>
            <td>SGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td scope="row">TOTALCFT</td>
            <td>Per CFT(Kgs)</td>
            <td width="68">Actual CFT(Kgs)</td>
            <td width="60">Charged Weight (Kgs)</td>
            <td colspan="4">Seal of the Compnay with date</td>
            <td>&nbsp;</td>
            <td>IGST@</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th rowspan="2" scope="row">&nbsp;</th>
            <td rowspan="2">&nbsp;</td>
            <td rowspan="2">&nbsp;</td>
            <td rowspan="2">&nbsp;</td>
            <td colspan="4" rowspan="2">&nbsp;</td>
            <td>&nbsp;</td>
            <td>G.TOTAL</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" align="center"><strong>Transport ID: 27AFOFSO431C1Z7</strong></td>
        </tr>
        <tr>
            <td colspan="2" scope="row">QUALITY & QUANTITY NOT CHECKED</td>
            <td colspan="2">REMARKS</td>
            <td colspan="3">ENSORSEMENT</td>
            <td colspan="3">GENERAL INFORMATION</td>
            <td colspan="2" style="font-size:10px;">SHREE LOGISTICS SOLUTIONS</td>
        </tr>
        <tr>
            <td colspan="2" scope="row">Signature of the Consignor of his agent</td>
            <td colspan="2">Unloding by Consignee</td>
            <td colspan="3">If is Intended to use the CONSIGNEE Copy of this set forthe purpose of borrowing from the Consignee bank</td>
            <td colspan="3">This is not a GST Invoice For <br />
                Tax Invoice Contact to our branch</td>
            <td colspan="2"><span style="font-size:10px;">Employee Name</span></td>
        </tr>
    </table>

    <p>&nbsp;</p>

</body>

</html>