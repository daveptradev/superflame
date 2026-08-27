<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Order;
use App\Models\LiveSet;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {

        // COUNTS
        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $totalLivesets = LiveSet::count();

        $totalEvents = Event::count();

        // REVENUE
        $totalRevenue = Order::where('payment_status', 'paid')
            ->sum('total');

        // LATEST
        $latestOrders = Order::latest()
            ->take(5)
            ->get();

        $latestProducts = Product::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(

            'totalProducts',

            'totalOrders',

            'totalLivesets',

            'totalEvents',

            'totalRevenue',

            'latestOrders',

            'latestProducts'
        ));
    }
}