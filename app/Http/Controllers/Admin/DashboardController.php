<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalRevenue = Order::sum('total');
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'recentOrders'
        ));
    }
}
