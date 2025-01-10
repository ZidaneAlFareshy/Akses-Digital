<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function index(Request $request)
    {
        $query = Expense::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('category', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('amount', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $expenses = $query->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category' => 'required|string|max:255' . $expense->expense_id . ',Expense_id',
            'amount' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $expense->update([
            'category' => $request->category,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        // $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
