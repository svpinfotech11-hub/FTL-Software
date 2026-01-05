<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::latest()->get();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        $branchCode = 'BC' . str_pad(Branch::count() + 1, 4, '0', STR_PAD_LEFT);

        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();
        return view('branches.create', compact('branchCode', 'states'));
    }

    public function store(Request $request)
    {
        Branch::create($request->all());
        return redirect()->route('branches.index')->with('success', 'Branch Added Successfully');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();
        return view('branches.edit', compact('branch', 'states'));
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return redirect()->route('branches.index')->with('success', 'Branch Updated Successfully');
    }

    public function destroy($id)
    {
        Branch::findOrFail($id)->delete();
        return back()->with('deleted', 'Branch Deleted Successfully');
    }
}
