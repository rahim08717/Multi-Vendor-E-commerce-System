<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart($id)
    {

        $product = Product::findOrFail($id);


        $cart = session()->get('cart', []);


        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {

            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                "seller_id" => $product->seller_id
            ];
        }


        session()->put('cart', $cart);

       
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function remove($id)
    {

        $cart = session()->get('cart');


        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }


        return redirect()->back()->with('success', 'Item removed successfully!');
    }
}
