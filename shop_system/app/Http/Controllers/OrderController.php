<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');
        
        // Get counts for all statuses
        $pendingCount = Order::where('status', 'pending')->count();
        $completedCount = Order::where('status', 'completed')->count();
        $cancelledCount = Order::where('status', 'cancelled')->count();
        
        if ($filter === 'all') {
            $orders = Order::all();
        } else {
            $orders = Order::where('status', $filter)->get();
        }
        
        return view('order.order', compact('orders', 'filter', 'pendingCount', 'completedCount', 'cancelledCount'));
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('order.order-show', compact('order'));
    }

    /**
     * Update the specified order status.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('order.index')->with('success', 'Order status updated successfully!');
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('order.order-create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        Order::create([
            'order_id' => 'ORD-' . time(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'shipping_info' => [
                'name' => $request->customer_name,
                'phone' => $request->phone ?? '',
                'address' => $request->address ?? '',
            ],
            'items' => [],
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        return redirect()->route('order.index')->with('success', 'Order created successfully!');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully!');
    }
}
