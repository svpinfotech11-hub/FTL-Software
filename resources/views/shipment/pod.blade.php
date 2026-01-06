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
        <table>
            <!-- HEADER -->
            <tr>
                <td colspan="6" class="bold">GSTIN: 27AFOFS0431C1Z7</td>
                <td colspan="3" class="center bold">GR No. 3001</td>
                <td colspan="3" class="bold right">PAN NO: AFOFS0421C</td>
            </tr>

            <tr>
                <td colspan="2" class="bold">AT OWNER'S RISK</td>
                <td colspan="2" class="bold">MODVAT COPY</td>
                <td colspan="2" class="bold">BOOKING MODE</td>
                <td colspan="2" class="bold">DATE</td>
                <td colspan="2" class="bold">RATE</td>
                <td colspan="2" class="bold">FREIGHT DETAILS</td>
            </tr>

            <tr>
                <td colspan="12" class="small">
                    Subject to Bhiwandi Jurisdiction only
                </td>
            </tr>

            <!-- CONSIGNOR / CONSIGNEE -->
            <tr>
                <td colspan="6" class="bold">Consignor</td>
                <td colspan="6" class="bold">Consignee</td>
            </tr>

            <tr class="height-60">
                <td colspan="6"></td>
                <td colspan="6"></td>
            </tr>

            <tr>
                <td colspan="3">GST NO.</td>
                <td colspan="3">Phone No.</td>
                <td colspan="3">GST NO.</td>
                <td colspan="3">Phone No.</td>
            </tr>

            <tr>
                <td colspan="6"><b>FROM:</b></td>
                <td colspan="6"><b>TO:</b></td>
            </tr>

            <!-- CONSIGNMENT DETAILS -->
            <tr>
                <td colspan="6" class="bold">CONSIGNMENT DETAILS</td>
                <td colspan="6" class="bold">PAYMENT TERMS</td>
            </tr>

            <tr>
                <td>No. of Pkgs</td>
                <td>Type of Packing</td>
                <td colspan="2">Item Description</td>
                <td colspan="2">Freight Mode</td>
                <td colspan="3">Billing Station</td>
                <td colspan="3" class="bold center">FREIGHT DETAILS</td>
            </tr>

            <tr>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
                <td colspan="2" rowspan="2"></td>
                <td colspan="2" rowspan="2"></td>
                <td colspan="3" rowspan="2"></td>
                <td>Rate</td>
                <td>Rs.</td>
                <td>P.</td>
            </tr>

            <tr>
                <td>Freight</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="3">In Figures</td>
                <td colspan="3">
                    If paid by Cash/Cheque, Specify amount (in Figures) Rs.
                </td>
                <td colspan="3"></td>
                <td>S.T. Charges</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="3">In Words</td>
                <td colspan="3">Invoice No(s)</td>
                <td colspan="3"></td>
                <td>Surcharge</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="3">Date</td>
                <td colspan="3">E-Way Bill No.</td>
                <td colspan="3"></td>
                <td>Hamali (Booking)</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="3">Gross Invoice Value</td>
                <td colspan="3">E-Way Bill Date</td>
                <td colspan="3"></td>
                <td>F.O.V</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="3">Net Invoice Value</td>
                <td colspan="3">
                    Consignment Acknowledgement by Consignee
                </td>
                <td colspan="3"></td>
                <td>Collection Charges</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>Dimension (inches)</td>
                <td colspan="2">Part(s)</td>
                <td colspan="3">Signature</td>
                <td colspan="3"></td>
                <td>Delivery Charges</td>
                <td></td>
                <td></td>
            </tr>

            <!-- WEIGHT -->
            <tr>
                <td class="bold">TOTAL CFT</td>
                <td>Per CFT (Kgs)</td>
                <td>Actual CFT (Kgs)</td>
                <td>Charged Weight (Kgs)</td>
                <td colspan="5">Seal of the Company with date</td>
                <td>Detention Charges</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>Logistic Charges</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>Demurrage Charges</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>Hamali (Delivery)</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>Others</td>
                <td></td>
                <td></td>
            </tr>

            <!-- TOTAL -->
            <tr>
                <td colspan="9"></td>
                <td class="bold">TOTAL</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>CGST @</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>SGST @</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td>IGST @</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="9"></td>
                <td class="bold">G. TOTAL</td>
                <td></td>
                <td></td>
            </tr>

            <!-- FOOTER -->
            <tr>
                <td colspan="3" class="bold">QUALITY & QUANTITY NOT CHECKED</td>
                <td colspan="3" class="bold">REMARKS</td>
                <td colspan="3" class="bold">ENDORSEMENT</td>
                <td colspan="3" class="bold center">
                    GENERAL INFORMATION<br>
                    SHREE LOGISTICS SOLUTIONS
                </td>
            </tr>

            <tr>
                <td colspan="3">Signature of the Consignor or his agent</td>
                <td colspan="3">Unloading by Consignee</td>
                <td colspan="3">
                    If is intended to use the CONSIGNEE Copy of this set
                    for the purpose of borrowing from the Consignee bank
                </td>
                <td colspan="3">
                    This is not a GST Invoice.<br>
                    For Tax Invoice Contact to our branch<br><br>
                    Employee Name
                </td>
            </tr>

        </table>

</body>

</html>
