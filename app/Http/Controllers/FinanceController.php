<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{

    public function index(Request $request)
    {
        $query = Finance::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('customer_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('project_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('amount', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $finance = $query->paginate(10);

        return view('finance.index', compact('finance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'project_name' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'date' => 'required|date',
            'payment_method' => 'required|string|max:255',
        ]);

        Finance::create($request->all());
        return redirect()->route('finance.index')->with('success', 'Finance added successfully.');
    }

    public function update(Request $request, Finance $finance)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255' . $finance->income_id . ',income_id',
            'project_name' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'date' => 'required|date',
            'payment_method' => 'required|string|max:255',
        ]);

        $finance->update([
            'customer_name' => $request->customer_name,
            'project_name' => $request->project_name,
            'amount' => $request->amount,
            'date' => $request->date,
            'payment_method' => $request->payment_method,
        ]);

        // $finance->update($request->all());
        return redirect()->route('finance.index')->with('success', 'Finance updated successfully.');
    }

    public function destroy(Finance $finance)
    {
        $finance->delete();
        return redirect()->route('finance.index')->with('success', 'Finance deleted successfully.');
    }
}
