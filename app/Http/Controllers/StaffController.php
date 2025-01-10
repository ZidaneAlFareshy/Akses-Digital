<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = Staff::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone_number', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Pagination with 10 staffs per page
        $staffs = $query->paginate(10);

        return view('staff.index', compact('staffs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff',
            'phone_number' => 'required|string|max:15',
            'staff_birth_date' => 'required|date',
            'role' => 'required|in:super admin,manager,staff,finance',
        ]);

        Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'staff_birth_date' => $request->staff_birth_date,
            'role' => $request->role,
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff added successfully.');
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff,email,' . $staff->id,
            'phone_number' => 'required|string|max:15',
            'staff_birth_date' => 'required|date',
            'role' => 'required|in:super admin,manager,staff,finance',
        ]);

        $staff->update($request->only(['name', 'email', 'phone_number', 'staff_birth_date', 'role']));

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully.');
    }
}
