<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->get();

        return view('welcome', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product || $product->status != 'active') {
            return redirect()->back()->with('error', 'Product not found!');
        }

        return view('frontend.product_details', compact('product'));
    }
}
