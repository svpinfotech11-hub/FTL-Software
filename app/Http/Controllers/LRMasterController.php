<?php

namespace App\Http\Controllers;

use App\Models\LRMaster;
use Illuminate\Http\Request;

class LRMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lrmasters.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lrmasters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LRMaster $lRMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LRMaster $lRMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LRMaster $lRMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LRMaster $lRMaster)
    {
        //
    }
}
