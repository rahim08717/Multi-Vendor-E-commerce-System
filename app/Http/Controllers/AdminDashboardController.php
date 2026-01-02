<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $totalCustomers = User::where('role', 'customer')->count();


        $totalSellers = User::where('role', 'seller')->count();


        $totalOrders = Order::count();


        $totalRevenue = Order::sum('total_amount');

       
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalCustomers', 'totalSellers', 'totalOrders', 'totalRevenue', 'pendingOrders'));
    }
}
