<?php

namespace App\Http\Controllers;

use App\Models\AddExpense;
use App\Models\DomesticShipment;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddExpenseController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $expenses = AddExpense::with('driver')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('add_expenses.index', compact('expenses'));
    }

    public function create()
    {
        $userId = Auth::id();

        $drivers  = Driver::where('user_id', $userId)->get();
        $vehicles = Vehicle::where('user_id', $userId)->get();

        $usedLrNos = AddExpense::where('user_id', $userId)
            ->whereNotNull('lr_no')
            ->pluck('lr_no')
            ->toArray();

        $airwayNos = DomesticShipment::whereNotIn('airway_no', $usedLrNos)
            ->pluck('airway_no', 'id');

        return view('add_expenses.create', compact(
            'drivers',
            'vehicles',
            'airwayNos'
        ));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $data = $request->validate([
            'expense_date' => 'required|date',
            'expense_type' => 'required|string',
            'vehicle_no'   => 'required|string',
            'driver_id'    => 'required|exists:drivers,id',
            'lr_no'        => 'nullable|string',
            'amount'       => 'required|numeric',
            'description'  => 'nullable|string',
            'attachment'   => 'nullable|file',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->store('expenses', 'public');
        }

        $data['user_id'] = $userId;

        AddExpense::create($data);

        return redirect()
            ->route('add-expenses.index')
            ->with('success', 'Expense added successfully');
    }

    public function edit($id)
    {
        $userId = Auth::id();

        $expense = AddExpense::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $drivers  = Driver::where('user_id', $userId)->get();
        $vehicles = Vehicle::where('user_id', $userId)->get();

        $airwayNos = DomesticShipment::pluck('airway_no', 'id');

        return view('add_expenses.edit', compact(
            'expense',
            'drivers',
            'vehicles',
            'airwayNos'
        ));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $expense = AddExpense::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $data = $request->validate([
            'expense_date' => 'required|date',
            'expense_type' => 'required|string',
            'vehicle_no'   => 'required|string',
            'driver_id'    => 'required|exists:drivers,id',
            'lr_no'        => 'nullable|string',
            'amount'       => 'required|numeric',
            'description'  => 'nullable|string',
            'attachment'   => 'nullable|file',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')
                ->store('expenses', 'public');
        }

        $expense->update($data);

        return redirect()
            ->route('add-expenses.index')
            ->with('success', 'Expense updated successfully');
    }

    public function destroy($id)
    {
        $userId = Auth::id();

        $expense = AddExpense::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $expense->delete();

        return redirect()
            ->route('add-expenses.index')
            ->with('success', 'Expense deleted successfully');
    }
}
