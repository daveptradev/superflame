<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{

    // =========================
    // INDEX
    // =========================

    public function index()
    {
    
        $orders = Order::where(function ($query) {
    
            $query->where('payment_status', '!=', 'pending')
                  ->orWhere('status', '!=', 'pending');
    
        })->latest()->get();
    
        return view('admin.orders.index', compact('orders'));
    }

    // =========================
    // SHOW DETAIL
    // =========================

    public function show(Order $order)
    {

        // LOAD ITEMS
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    // =========================
    // UPDATE STATUS
    // =========================

    public function update(Request $request, Order $order)
    {

        $request->validate([

            'status' => 'required'
        ]);

        $order->update([

            'status' => $request->status
        ]);

        return back()
            ->with('success', 'Order updated successfully');
    }
}