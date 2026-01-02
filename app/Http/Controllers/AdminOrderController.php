<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ActivityLog;
class AdminOrderController extends Controller
{

    public function index()
    {

        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function activityLogs()
    {

        $logs = ActivityLog::latest()->paginate(20);

        return view('admin.logs', compact('logs'));
    }

    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);

        if($order) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('success', 'Order status updated successfully!');
        }

        return redirect()->back()->with('error', 'Order not found!');
    }
}
