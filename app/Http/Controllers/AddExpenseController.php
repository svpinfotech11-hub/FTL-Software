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
        $user = Auth::user();
        $query = AddExpense::with('driver');

        if ($user->hasRole('super_admin')) {
            // Super admin sees all expenses
            $expenses = $query->latest()->get();
        } elseif ($user->hasRole('admin')) {
            // Admin sees expenses created by themselves and their created users
            $userIds = \App\Models\User::where('created_by', $user->id)->orWhere('id', $user->id)->pluck('id');
            $expenses = $query->whereIn('user_id', $userIds)->latest()->get();
        } else {
            // Regular users see only their own expenses
            $expenses = $query->where('user_id', $user->id)->latest()->get();
        }

        return view('add_expenses.index', compact('expenses'));
    }

    public function create()
    {
        $userId = Auth::id();

        // Drivers & Vehicles for logged-in user
        $drivers = Driver::where('user_id', $userId)->get();
        $vehicles = Vehicle::where('user_id', $userId)->get();

        /**
         * Exclude LR numbers already used in expenses
         */
        $usedLrNos = AddExpense::where('user_id', $userId)
            ->whereNotNull('lr_no')
            ->pluck('lr_no')
            ->toArray();

        /**
         * Available LR / Airway numbers
         * pluck(value, key)
         */
        $airwayNos = DomesticShipment::where('user_id', $userId)
            ->whereNotIn('airway_no', $usedLrNos)
            ->pluck('airway_no');

        return view('add_expenses.create', compact(
            'drivers',
            'vehicles',
            'airwayNos'
        ));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        // Validate request
        $data = $request->validate([
            'expense_date'    => 'required|date',
            'expense_type' => 'required|array',
            'expense_type.*' => 'string|max:255',
            'vehicle_id'      => 'nullable|exists:vehicles,id',
            'driver_id'       => 'nullable|exists:drivers,id',
            'lr_no'           => 'nullable|string|max:255',
            'amount'          => 'required|numeric',
            'description'     => 'nullable|string',
            'attachment'      => 'nullable|array',
            'attachment.*'    => 'file|mimes:jpg,jpeg,png,pdf,doc',
            'paid_by'         => 'nullable|in:Company,Driver,Vendor',
            'vehicle_hire_id' => 'nullable|exists:vehicle_hires,id',
        ]);

        // Handle file upload to public folder
        if ($request->has('expense_type')) {
            $data['expense_type'] = $request->expense_type; // array save
        }

        // Multiple attachments upload
        if ($request->hasFile('attachment')) {
            $files = [];
            foreach ($request->file('attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move('uploads/expenses', $filename);
                $files[] = $filename;
            }
            $data['attachment'] = $files;
        }


        // Add authenticated user
        $data['user_id'] = $userId;

        // Default 'paid_by' if not sent
        if (empty($data['paid_by'])) {
            $data['paid_by'] = 'Company';
        }

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

        // Find the expense for this user
        $expense = AddExpense::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        // Validate request
        $data = $request->validate([
            'expense_date'    => 'required|date',
            'expense_type' => 'required|array',
            'expense_type.*' => 'string|max:255',
            'vehicle_id'      => 'nullable|exists:vehicles,id',
            'driver_id'       => 'nullable|exists:drivers,id',
            'lr_no'           => 'nullable|string|max:255',
            'amount'          => 'required|numeric',
            'description'     => 'nullable|string',
            'attachment'      => 'nullable|array',
            'attachment.*'    => 'file|mimes:jpg,jpeg,png,pdf,doc',
            'paid_by'         => 'nullable|in:Company,Driver,Vendor',
        ]);

        // Update expense types
        if ($request->has('expense_type')) {
            $data['expense_type'] = $request->expense_type;
        }

        // Multiple file update
        if ($request->hasFile('attachment')) {

            // Old files delete
            if (!empty($expense->attachment)) {
                foreach ($expense->attachment as $oldFile) {
                    $path = public_path('uploads/expenses/' . $oldFile);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            $files = [];
            foreach ($request->file('attachment') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move('uploads/expenses', $filename);
                $files[] = $filename;
            }

            $data['attachment'] = $files;
        }


        // Default paid_by if not sent
        if (empty($data['paid_by'])) {
            $data['paid_by'] = 'Company';
        }

        // Update the expense
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
