<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $query = Customer::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('customer_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('company', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $customers = $query->paginate(10);

        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:customer,email',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'company' => 'nullable|string|max:255',
        ]);

        Customer::create($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'email' => 'required|email|unique:customer,email,' . $customer->customer_id . ',customer_id',
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'company' => 'nullable|string|max:255',
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
