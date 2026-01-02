<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('front.home')->with('error', 'Your cart is empty!');
        }

        return view('frontend.checkout');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $cart = session('cart');
        $total_amount = 0;

        foreach ($cart as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $total_amount,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'seller_id' => $item['seller_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        // --- Activity Log Start ---
       ActivityLog::create([
            'user_id'     => Auth::id(),
            'name'        => Auth::user()->name,
            'role'        => 'customer',            
            'description' => 'Placed a new order. Total Amount: ' . $total_amount . ' Tk',
        ]);
        // --- Activity Log End ---

        return redirect()->route('front.home')->with('success', 'Order placed successfully! Thank you.');
    }
}
