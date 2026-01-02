<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ActivityLog;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create product')->only(['create', 'store']);
        $this->middleware('permission:edit product')->only(['edit', 'update']);
        $this->middleware('permission:delete product')->only(['destroy']);
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $totalProducts = Product::where('seller_id', $userId)->count();

        $totalSoldItems = OrderItem::where('seller_id', $userId)->sum('quantity');

        $totalEarnings = OrderItem::where('seller_id', $userId)
                            ->selectRaw('sum(price * quantity) as total')
                            ->value('total');

        $totalEarnings = $totalEarnings ?? 0;

        return view('seller.dashboard', compact('totalProducts', 'totalSoldItems', 'totalEarnings'));
    }

    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->latest()->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'seller_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
            'status' => 'active',
        ]);

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'name'        => Auth::user()->name,
            'role'        => 'seller',
            'description' => 'Created a new product named: ' . $request->name,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product uploaded successfully!');
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product || $product->seller_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product || $product->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product || $product->seller_id !== Auth::id()) {
            abort(403);
        }

        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            unlink(public_path('uploads/products/' . $product->image));
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Product deleted successfully!');
    }

    public function orders()
    {
        $orders = OrderItem::where('seller_id', Auth::id())
                            ->with(['product', 'order'])
                            ->latest()
                            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $orderId)
    {
        $order = \App\Models\Order::find($orderId);

        if (!$order) {
            return back()->with('error', 'Order not found.');
        }

        $order->status = $request->status;
        $order->save();

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'name'        => Auth::user()->name,
            'role'        => 'seller',
            'description' => 'Updated Order #' . $order->id . ' status to ' . $request->status,
        ]);

        return back()->with('success', 'Order Status Updated Successfully!');
    }
}
