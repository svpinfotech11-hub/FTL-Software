<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;

class FTLReportController extends Controller
{
    public function billing(Request $request)
    {

        return view('flt_reports.billing_register');
    }

    public function pending(Request $request)
    {

        return view('flt_reports.lr-pending');
    }
}
