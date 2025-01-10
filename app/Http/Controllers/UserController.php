<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua users dengan fitur search dan filter
    public function index(Request $request)
    {
        $query = User::query();

        // Search 
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone_number', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // range tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('birth_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('birth_date', '<=', $request->date_to);
        }

        // Pagination with 10 users per page
        $users = $query->paginate(10);
        return view('users.index', compact('users'));
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    // menambah data
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone_number' => 'nullable|string|max:15',
        'birth_date' => 'nullable|date',
        'role' => 'required|in:admin,user',
        'password' => 'required|string|min:8',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone_number' => $request->phone_number,
        'birth_date' => $request->birth_date,
        'role' => $request->role,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    // update data
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'role' => 'required|in:admin,user',
        ]);
    
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'role' => $request->role,
        ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


}