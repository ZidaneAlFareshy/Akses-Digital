<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('service', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $orders = $query->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'order_date' => 'required|date',
            'status' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:255',
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order added successfully.');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'service' => 'required|string|max:255' . $order->order_id . ',order_id',
            'details' => 'required|string|max:255',
            'order_date' => 'required|date',
            'status' => 'nullable|string|max:255',
            'price' => 'nullable|string|max:255',
        ]);

        $order->update([
            'service' => $request->service,
            'details' => $request->details,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        // $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
