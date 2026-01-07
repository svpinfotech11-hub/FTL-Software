<?php

namespace App\Http\Controllers;

use App\Models\AddExpense;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AddExpenseController extends Controller
{
    public function index()
    {
        $expenses = AddExpense::with('driver')->latest()->get();
        return view('add_expenses.index', compact('expenses'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        return view('add_expenses.create', compact('drivers', 'vehicles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'expense_date' => 'required|date',
            'expense_type' => 'required',
            'vehicle_no'   => 'required',
            'driver_id'    => 'required',
            'lr_no'        => 'nullable',
            'amount'       => 'required|numeric',
            'description'  => 'nullable',
            'attachment'   => 'nullable|file',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('expenses', 'public');
        }

        AddExpense::create($data);

        return redirect()->route('add-expenses.index')
            ->with('success', 'Expense added successfully');
    }

    public function edit($id)
    {
        $expense = AddExpense::findOrFail($id);
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        return view('add_expenses.edit', compact('expense', 'drivers', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $expense = AddExpense::findOrFail($id);

        $data = $request->validate([
            'expense_date' => 'required|date',
            'expense_type' => 'required',
            'vehicle_no'   => 'required',
            'driver_id'    => 'required',
            'lr_no'        => 'nullable',
            'amount'       => 'required|numeric',
            'description'  => 'nullable',
            'attachment'   => 'nullable|file',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('expenses', 'public');
        }

        $expense->update($data);

        return redirect()->route('add-expenses.index')
            ->with('success', 'Expense updated successfully');
    }

    public function destroy($id)
    {
        AddExpense::findOrFail($id)->delete();

        return redirect()->route('add-expenses.index')
            ->with('success', 'Expense deleted successfully');
    }
}
